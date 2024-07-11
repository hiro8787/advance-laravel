<?php

namespace App\Http\Controllers;
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

    public function search(Request $request)
    {
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
        //dd($detail);
        $reservation = $request->all();
        $reservation = Date::join('stores', 'stores.id', '=', 'dates.store_id')
            ->where('dates.user_id', $user->id)
            ->orderBy('dates.created_at', 'desc')
            ->first();
        //dd($reservation);
        $storeId = $request->input('id');
        $stores = Store::find($storeId);
        
        $dates = Date::with('store')->get();
        $name = $request->input('name');
        $image = $request->input('image');
        $location = $request->input('location');
        $category = $request->input('category');
        $explanation = $request->input('explanation');
        $times = Time::all();
        //dd($times);
        $numbers = Count::all();

        return view('detail',compact('detail', 'reservation', 'user', 'stores', 'dates', 'name', 'image', 'location', 'category', 'explanation', 'times','numbers'));
}

    public function thanks(){
        return view('thanks');
    }

    public function done(Request $request){
        $user = Auth::user();
        $dates = $request->all();
        Date::create($dates);
        $reservation = Date::join('stores', 'stores.id', '=', 'dates.store_id')
            ->where('dates.user_id', $user->id)
            ->orderBy('dates.created_at', 'desc')
            ->first();
        return view('done', compact('reservation'));
    }

    public function back(Request $request){
        return view('detail');
    }

    public function my_page(Request $request){
        //dd($request);
        $user = Auth::user();
        $likes = Like::join('users', 'users.id', '=', 'likes.user_id')
            ->join('stores', 'stores.id', '=', 'likes.store_id')
            ->where('likes.user_id', $user->id)
            ->orderBy('likes.created_at', 'desc')
            ->get();
        //dd($likes);
        
        $reservations = Date::with(['user','store'])->get();
        //dd($reservations);
        return view('my_page', compact('user', 'likes', 'reservations'));
    }

    public function delete(Request $request){
        //dd($request);
        Date::find($request->id)->delete();
        return redirect()->back();
    }
}