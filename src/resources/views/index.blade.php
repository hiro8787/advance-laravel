@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="form">
    <form class="form-category" method="GET" action="/index">
        @csrf
        <select class="store-information" name="store_location">
            <option value="">All area</option>
            <option value="東京都">東京都</option>
            <option value="大阪府">大阪府</option>
            <option value="福岡県">福岡県</option>
        </select>
        <select class="store-information" name="store_category">
            <option value="">All genre</option>
            <option value="寿司">寿司</option>
            <option value="焼肉">焼肉</option>
            <option value="居酒屋">居酒屋</option>
            <option value="イタリアン">イタリアン</option>
            <option value="ラーメン">ラーメン</option>
        </select>
        <i class="fa-solid fa-magnifying-glass"></i>
        <input class="search" type="search" placeholder="Search ..." name="keyword">
    </form>
</div>
<div class="store">
    <div class="store__img">
        <img src='https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg'>
    </div>
    <h2 class="store-name">仙人</h2>
    <p>#東京都 #寿司</p>
    <div class="store__content">
        <button class="store__content-cat">詳しく見る</button>
    </div>
</div>
@endsection