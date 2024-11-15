<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Models\User;
use App\Models\Store;
use App\Models\Date;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementController extends Controller
{
    public function representative(){
        return view('representative');
    }
    public function reservation_status(){
        $reserves = Date::query()
        ->join('users', 'users.id', '=', 'dates.user_id')
        ->join('stores', 'stores.id', '=', 'dates.store_id')
        ->orderBy('dates.reservation_date', 'asc')
        ->orderBy('dates.reservation_time', 'asc')
        ->Paginate(4);

        return view('reservation_status', compact('reserves'));
    }

    public function store_all(){
        $stores = Store::all();

        return view('store_all',compact('stores'));
    }

    public function store_edit(Request $request){
        $form = $request->input('id');
        $name = $request->input('store_name');
        $image = $request->input('image');
        $location = $request->input('location');
        $category = $request->input('category');
        $explanation = $request->input('explanation');
        $store = Store::find($form);
        $items = Store::select('location', 'category')->get();
        return view('store_edit', compact('form', 'store', 'items', 'image', 'name', 'location', 'category', 'explanation'));
    }

    public function store_update(UpdateRequest $request){
        $form = $request->all();
        unset($form['_token']);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('img'), $imageName);
            $form['image'] = 'img/' . $imageName;
        }
        store::find($request->id)->update($form);
        return redirect()->route('representative')->with('status', '店舗情報の修正が完了しました。');
    }
}
