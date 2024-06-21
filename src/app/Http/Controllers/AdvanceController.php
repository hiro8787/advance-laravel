<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Store;
use App\Models\Date;
use App\Models\Like;

use Illuminate\Http\Request;

class AdvanceController extends Controller
{
    public function index(){
        return view('index');
    }

    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function thanks(){
        return view('thanks');
    }


}
