<?php
namespace App\Http\Controllers;

use App\Http\Requests\AdvanceRequest;
use App\Http\Requests\TimeRequest;
use App\Http\Requests\PostRequest;
use App\Http\Requests\AdminRequest;
use App\Models\User;
use App\Models\Store;
use App\Models\Date;
use App\Models\Like;
use App\Models\Time;
use App\Models\Count;
use App\Models\Evaluation;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;

class AdvanceController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $loginAttempt = Auth::attempt($credentials);

        if($loginAttempt) {
            $user = Auth::user();
                if($user->email_verified_at === null) {
                    Auth::logout();
                    return redirect()->back()->with('error', '受信メールのURLより認証してください。');
                }
                if($user->role === 'admin') {
                    return redirect()->route('admin');
                }
            return redirect()->intended('/');
        }
        return redirect()->back()->with('error', 'ログインに失敗しました。');
    }

    public function adminDashboard(){
        return view('admin');
    }

    public function addition(){
        return view('addition');
    }

    public function import(AdminRequest $request) {
        $file = $request->file('csv_file');
        try {
            $data = array_map('str_getcsv', file($file->getRealPath()));
            $header = array_shift($data);

            foreach ($data as $row) {
                $storeData = array_combine($header, $row);
                \App\Models\Store::create([
                    'name' => $storeData['name'],
                    'image' => $storeData['image'],
                    'location' => $storeData['location'],
                    'category' => $storeData['category'],
                    'explanation' => $storeData['explanation'],
                ]);
            }

            return redirect()->back()->with('success', '店舗情報が登録されました。');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'CSVファイルの処理中にエラーが発生しました。');
        }
    }


    public function list(){
        $lists = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->join('stores', 'stores.id', '=', 'posts.store_id')
            ->get();

        return view('list', compact('lists'));
    }

    public function list_delete(Request $request){
        Post::find($request->id)->delete();

        return redirect()->route('admin');
    }

    public function index(Request $request){
        $query = Store::leftJoin('posts', 'stores.id', '=', 'posts.store_id')
            ->select('stores.*', DB::raw('AVG(posts.post) as average_rating'))
            ->groupBy('stores.id');

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'random':
                    $stores = Store::inRandomOrder()->get();
                    break;
                case 'high':
                    $storesWithRating = $query->orderBy('average_rating', 'desc')->get()->filter(function ($store) {
                        return !is_null($store->average_rating);
                    });
                    $storesWithoutRating = $query->get()->filter(function ($store) {
                        return is_null($store->average_rating);
                    })->shuffle();
                    $stores = $storesWithRating->concat($storesWithoutRating);
                    break;
                case 'low':
                    $storesWithRating = $query->orderBy('average_rating', 'asc')->get()->filter(function ($store) {
                        return !is_null($store->average_rating);
                    });
                    $storesWithoutRating = $query->get()->filter(function ($store) {
                        return is_null($store->average_rating);
                    })->shuffle();
                    $stores = $storesWithRating->concat($storesWithoutRating);
                    break;
                default:
                    $stores = $query->orderBy('stores.id')->get();
                    break;
            }
        } else {
            $stores = $query->orderBy('stores.id')->get();
        }

        return view('index', compact('stores'));
    }

    public function search(Request $request){
        $keyword = $request->input('keyword');
        $location = $request->input('location');
        $store_category = $request->input('store_category');

        $stores = Store::query()
            ->when($location, function ($query, $location) {
                return $query->where('location', $location);
            })
            ->when($store_category, function ($query, $store_category) {
                return $query->where('category', $store_category);
            })
            ->when($keyword, function ($query, $keyword) {
                return $query->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('category', 'LIKE', "%{$keyword}%");
                });
            })
            ->get();
        return view('index', compact('stores'));
    }

    public function toggleLike(Request $request){
        $user = Auth::user();
        $storeId = $request->input('store_id');
        $liked = Like::where('user_id', $user->id)->where('store_id', $storeId)->first();

        if ($liked) {
            $liked->delete();
        } else {
            Like::create([
                'user_id' => $user->id,
                'store_id' => $storeId,
            ]);
        }
        return redirect()->back();
    }

    public function detail(Request $request){
        $user = Auth::user();
        $detail = $request->input('id');
        $reservation = Date::join('stores', 'stores.id', '=', 'dates.store_id')
            ->where('dates.user_id', $user->id)
            ->where('dates.store_id', $request->store_id)
            ->orderBy('dates.created_at', 'desc')
            ->first();
        $dates = Date::with('store')->get();
        $name = $request->input('name');
        $image = $request->input('image');
        $location = $request->input('location');
        $category = $request->input('category');
        $explanation = $request->input('explanation');
        $times = Time::all();
        $numbers = Count::all();

        return view('detail',compact('user', 'detail', 'reservation', 'dates', 'name', 'image', 'location', 'category', 'explanation', 'times','numbers'));
    }

    public function done(TimeRequest $request){
        $user = Auth::user();
        $dates = $request->only(['id', 'user_id', 'store_id', 'reservation_date', 'reservation_time', 'people']);
        Date::create($dates);
        $reservation = Date::join('stores', 'stores.id', '=', 'dates.store_id')
            ->where('dates.user_id', $user->id)
            ->orderBy('dates.created_at', 'desc')
            ->first();

        return view('done', compact('reservation'));
    }

    public function back(){
        return view('detail');
    }

    public function my_page(){
        $user = Auth::user();
        $likes = Like::join('users', 'users.id', '=', 'likes.user_id')
            ->join('stores', 'stores.id', '=', 'likes.store_id')
            ->where('likes.user_id', $user->id)
            ->orderBy('likes.created_at', 'desc')
            ->get();
        $reservations = Date::with(['user','store'])
            ->where('dates.user_id', $user->id)
            ->get();
        $now = carbon::now();
        $review = Date::join('stores', 'stores.id', '=', 'dates.store_id')
            ->whereDate('reservation_date', '<', $now)
            ->get();

        return view('my_page', compact('user', 'likes', 'reservations', 'review'));
    }

    public function delete(Request $request){
        Date::find($request->id)->delete();

        return redirect()->back();
    }

    public function edit(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $date = $request->input('reservation_date');
        $time = $request->input('reservation_time');
        $people = $request->input('people');
        $times = Time::all();
        $numbers = Count::all();

        return view('edit', compact('id', 'name', 'date', 'time', 'people', 'times', 'numbers'));
    }

    public function update(TimeRequest $request){
        $form = $request->all();
        unset($form['_token']);
        Date::find($request->id)->update($form);

        return redirect('/my_page');
    }

    public function review(Request $request){
        $dateId =$request->input('id');
        $store = $request->input('store_id');
        $name = Store::find($store);

        return view('review',compact('name', 'dateId'));
    }

    public function posting(Request $request){
        $review = $request->only(['id', 'date_id', 'review', 'comment']);
        Evaluation::create($review);

        return view('posting');
    }

    public function confirmation(Request $request){
        $reservation = Date::find($request->id);
        return view('confirmation', compact('reservation'));
    }

    public function post(Request $request){
        $user = Auth::user();
        $store = Store::find($request->id);
        $liked = Like::where('user_id', $user->id)->where('store_id', $store)->first();

        return view('post', compact('user', 'liked', 'store'));
    }

    public function post_review(PostRequest $request){
        $user = Auth::user();
        $storeId = $request->input('store_id');
        $post_review = $request->input('post');
        $store = Store::findOrFail($storeId);
        $times = Time::all();
        $numbers = Count::all();
        $reservation = Date::join('stores', 'stores.id', '=', 'dates.store_id')
            ->where('dates.user_id', $user->id)
            ->where('dates.store_id', $request->store_id)
            ->orderBy('dates.created_at', 'desc')
            ->first();

        $existingPost = Post::where('store_id', $storeId)
            ->where('user_id', $user->id)
            ->whereNull('deleted_at')
            ->first();

        if ($existingPost) {
            $postId = $existingPost->id;
            $message = '既にレビュー済みです';
            return view('post_review',['post' => $existingPost],compact('message', 'existingPost', 'store', 'user', 'postId', 'post_review','times', 'numbers', 'reservation'));
        }
        $postData = $request->only(['id','user_id', 'store_id', 'post', 'description', 'image']);
        $post = Post::create($postData);
        $postId = $post->id;

        $dates = Date::with('store')->get();
        $name = $request->input('name');
        $image = $request->input('image');
        $location = $request->input('location');
        $category = $request->input('category');
        $explanation = $request->input('explanation');

        return view('post_review',compact('post', 'post_review', 'postId', 'user', 'store', 'reservation', 'dates', 'name', 'image', 'location', 'category', 'explanation', 'times','numbers', 'existingPost'));
    }

    public function post_edit(Request $request) {
        $edit = Post::find($request->id);
        $user = Auth::user();
        $store = $request->all();
        $post = Post::where('user_id', $user->id)->latest()->first();
        $liked = Like::where('user_id', $user->id)->where('store_id', $store)->first();

        return view('post_edit', compact('user', 'liked', 'store', 'post'));
    }

    public function post_update(Request $request) {
        $update = $request->all();
        unset($update['_token']);
        Post::find($request->id)->update($update);
        return redirect('/')->with('flash_message', 'レビューの変更が完了しました');
    }

    public function post_delete(Request $request) {
        $post = Post::find($request->id);
        if ($post) {
            $post->delete();
        }
        $query = DB::table('stores');
        $stores = $query->get();
        $authors = User::all();

        return redirect()->route('index')->with('flash_message', 'レビューを削除しました');
    }

    public function all_post(){
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->join('stores', 'stores.id', '=', 'posts.store_id')
            ->get();

        return view('all_post', compact('posts'));
    }
}