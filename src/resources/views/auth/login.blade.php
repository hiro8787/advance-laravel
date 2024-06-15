@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="main-item">Login
    <form class="form" method="POST" action="/login">
        @csrf
        <div class="form-item">
            <div class="form-item-text">&#x2709;
                <input type="email" name="email" class="form-item-input" placeholder="Email" value="{{ old('email') }}"/>
            </div>
            @error('email')
            {{$errors->first('email')}}
            @enderror
            <div class="form-item-text">
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
        </div>
    </form>
</div>

@endsection