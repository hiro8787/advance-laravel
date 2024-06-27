@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="form">
    <form class="form-category" method="GET" action="/index">
        @csrf
        <div class="store-tag">
            <select class="store-information" name="store_location">
                <option value="">All area</option>
                <option value="東京都">東京都</option>
                <option value="大阪府">大阪府</option>
                <option value="福岡県">福岡県</option>
            </select>
        </div>
        <div class="store-tag">
            <select class="store-information" name="store_category">
                <option value="">All genre</option>
                <option value="寿司">寿司</option>
                <option value="焼肉">焼肉</option>
                <option value="居酒屋">居酒屋</option>
                <option value="イタリアン">イタリアン</option>
                <option value="ラーメン">ラーメン</option>
            </select>
        </div>
        <div class="search-item">
        <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <input class="search" type="search" placeholder="Search ..." name="keyword">
    </form>
</div>
@foreach($stores as $store)
<div class="store" id="{{$store->id}}">
    <div class="store__img">
        <img src="{{$store->image}}" alt="" />
    </div>
    <h2 class="store-name">{{$store->name}}</h2>
    <p>#{{$store->location}} #{{$store->category}}</p>
    <div class="store__content">
        <button class="store__content-cat">詳しく見る</button>
    </div>
    <form action="{{ route('like.toggle') }}" method="post">
        @csrf
        <input type="hidden" name="store_id" value="{{$store->id}}">
        @if (Auth::check())
            @php
                $liked = Auth::user()->likes()->where('store_id', $store->id)->exists();
            @endphp
            <button type="submit" class="like-button" style="color: {{ $liked ? 'pink' : 'gray' }};">
                <i class="fa-solid fa-heart"></i>
            </button>
        @else
            <button type="submit" class="like-button" disabled>
                <i class="fa-solid fa-heart"></i>
            </button>
        @endif
    </form>
</div>
@endforeach
</div>
@endsection