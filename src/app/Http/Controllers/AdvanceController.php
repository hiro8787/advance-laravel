<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Store;
use App\Models\Date;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdvanceController extends Controller
{
    public function index(){
       //$this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
        $store = DB::table('stores')->get();
        return view('index', compact('store'));
    }

    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function like($id){
        Like::create([
            'store_id' => $id,
            'user_id' => Auth::id(),
        ]);
        return redirect()->back();
    }
    public function unlike($id){
        $like = Like::where('store_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();
        return redirect()->back();
    }



    public function thanks(){
        return view('thanks');
    }


}
