<?php

namespace App\Http\Controllers;

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

    public function store_update(){
        $stores = Store::all();

        return view('store_update',compact('stores'));
    }
}
