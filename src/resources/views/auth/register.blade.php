@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="main">
    <div class="main-item">Registration</div>
    <form class="form" method="POST" action="/register">
        @csrf
        <div class="form-item">
            <div class="form-item-text">
                <i class="fa-solid fa-user"></i>
                <input type="name" name="name" class="form-item-input" placeholder="Username" value="{{ old('name') }}"/>
            </div>
            <div class="error">
                @error('name')
                {{$errors->first('name')}}
                @enderror
            </div>
            <div class="form-item-text">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" class="form-item-input" placeholder="Email" value="{{ old('email') }}"/>
            </div>
            <div class="error">
                @error('email')
                {{$errors->first('email')}}
                @enderror
            </div>
            <div class="form-item-text">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" class="form-item-input" placeholder="Password" value="{{ old('password') }}"/>
            </div>
            <div class="error">
                @error('password')
                {{$errors->first('password')}}
                @enderror
            </div>
            <div class="form-item-category">
                <button type="submit" class="form-item-btn">登録</button>
            </div>
        </div>
    </form>
</div>
@endsection