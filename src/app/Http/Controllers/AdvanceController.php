<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvanceRequest;
use App\Models\User;
use App\Models\Store;
use App\Models\Date;
use App\Models\Like;
use App\Models\Time;
use App\Models\Count;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvanceController extends Controller
{
    public function index(){
    $query = DB::table('stores');
    $stores = $query->get();
    $authors = User::all();

    return view('index', compact('stores', 'authors'));
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
        $detail = $request->input('store_id');
        $reservation = Date::join('stores', 'stores.id', '=', 'dates.store_id')
            ->where('dates.user_id', $user->id)
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

    public function register(Request $request){
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        return view('thanks');
    }

    public function done(AdvanceRequest $request){
        $user = Auth::user();
        $dates = $request->all();
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

        return view('my_page', compact('user', 'likes', 'reservations'));
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

    public function update(AdvanceRequest $request){
        $form = $request->all();
        unset($form['_token']);
        Date::find($request->id)->update($form);
        return redirect('/my_page');
    }
}