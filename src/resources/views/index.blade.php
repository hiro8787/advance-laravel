@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="store">
    <div class="store__img">
        <img src='https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg'>
    </div>
</div>
<h2 class="store-name">仙人</h2>
<p>#東京都 #寿司</p>
<div class="store__content">
    <div class="store__content-cat">詳しく見る</div>
</div>
@endsection