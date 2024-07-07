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
        //dd($request);
        $storeId = $request->input('id');
        $stores = Store::find($storeId);
    //dd($storeId);
    //dd($stores);
        $user = Auth::user();
    //dd($user);
    //$detail = Date::where('user_id', $user->id)->first();
    //dd($detail);
        $dates = Date::with('store')->get();
    
    

    $name = $request->input('name');
    $image = $request->input('image');
    $location = $request->input('location');
    $category = $request->input('category');
    $explanation = $request->input('explanation');

    $times = Time::all();
    $numbers = Count::all();
    return view('detail',compact('user', 'stores', 'dates', 'name', 'image', 'location', 'category','explanation', 'times','numbers'));
}

    public function thanks(){
        return view('thanks');
    }

    public function done(Request $request){
    $dates = $request->all();
    Date::create($dates);
    //$userId = $request->id;
    //$user = User::find($userId);
    $name = $request->input('name');
    $image = $request->input('image');
    $location = $request->input('location');
    $category = $request->input('category');
    $explanation = $request->input('explanation');
    //dd($request);
    return view('done', compact('dates', 'name', 'image', 'location', 'category', 'explanation'));
    }

    public function back(Request $request){
        return view('detail');
    }

    public function my_page(Request $request){
        $user = Auth::user();
        //$date = Date::all();
        $reservations = Date::with(['user','store'])->get();
        //dd($reservations);
        return view('my_page', compact('user', 'reservations'));
    }
}