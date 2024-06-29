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
use Carbon\Carbon;

class AdvanceController extends Controller
{
    public function index(){
       //$this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
        $stores = DB::table('stores')->get();
        $authors = User::all();
        return view('index', compact('stores','authors'));
    }

    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function toggleLike(Request $request){
        $user = Auth::user();
        $storeId = $request->input('store_id');

        $like = Like::where('user_id', $user->id)->where('store_id', $storeId)->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => $user->id,
                'store_id' => $storeId,
            ]);
        }

        return redirect()->back();
    }
    /*
    public function unlike($id){
        $like = Like::where('store_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();
        session()->flash('success', 'You Unliked the Reply.');
        return redirect()->back();
    }
*/
    public function detail(Request $request){
    $name = $request->input('name');
    $image = $request->input('image');
    $location = $request->input('location');
    $category = $request->input('category');
    $explanation = $request->input('explanation');
    $dates = Time::all();
    $numbers = Count::all();
    return view('detail',compact('name','image','location','category','explanation','dates','numbers'));
}

    public function thanks(){
        return view('thanks');
    }


}
