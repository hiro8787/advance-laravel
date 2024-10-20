@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="main">
    <div class="main-item">
        <div class="main-title">Login</div>
        <form class="form" method="POST" action="/login">
            @csrf
            <div class="form-item">
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
                    <button type="submit" class="form-item-btn">ログイン</button>
                </div>
                @if (session('status'))
                <div class="certification">{{ session('status') }}</div>
                @endif
                @if (session('error'))
                <div class="certification">{{ session('error') }}</div>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection