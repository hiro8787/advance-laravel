@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="form">
    @if (session('flash_message'))
        <div class="flash_message">
            {{ session('flash_message') }}
        </div>
    @endif
    <form action="/" method="GET">
        @csrf
        <div class="sort">
            <select class="sort-content" name="sort" onchange="this.form.submit()">
                <option value="">並び替え：評価高/低</option>
                <option value="random" {{ request('sort') == 'random' ? 'selected' : '' }}>ランダム</option>
                <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>評価が高い順</option>
                <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>評価が低い順</option>
            </select>
        </div>
    </form>
    <form class="form-category" method="GET" action="/search">
        @csrf
        <div class="store-tag">
            <select class="store-information" name="location">
                <option value="">All area</option>
                @foreach($stores->unique('location') as $store)
                <option value="{{$store->location}}">{{$store->location}}</option>
                @endforeach
            </select>
        </div>
        <div class="store-item">
            <i class="fa-solid fa-caret-down"></i>
        </div>
        <div class="store-tag">
            <select class="store-information" name="store_category">
                <option value="">All genre</option>
                @foreach($stores->unique('category') as $store)
                <option value="{{$store->category}}">{{$store->category}}</option>
                @endforeach
            </select>
        </div>
        <div class="store-item">
            <i class="fa-solid fa-caret-down"></i>
        </div>
        <div class="search-item">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <input class="search" type="search" placeholder="Search ..." name="keyword" value="{{ request('keyword') }}">
    </form>
</div>
<div class="store-all">
    @foreach($stores as $store)
    @if((request('location') == '' || request('location') == $store->location) &&
        (request('keyword') == '' || stripos($store->store_name, request('keyword')) !== false || stripos($store->category, request('keyword')) !== false))
    <div class="store" id="{{$store->id}}">
        <div class="store-img">
            <img class="store-img__item" src="{{$store->image}}" alt="" />
        </div>
        <p class="store-name">{{$store->store_name}}</p>
        <p class="store-name__tag">#{{$store->location}} #{{$store->category}}</p>
        <div class="store-content">
            <form action="/detail" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$store->id}}">
                <input type="hidden" name="store_name" value="{{$store->store_name}}">
                <input type="hidden" name="image" value="{{$store->image}}">
                <input type="hidden" name="location" value="{{$store->location}}">
                <input type="hidden" name="category" value="{{$store->category}}">
                <input type="hidden" name="explanation" value="{{$store->explanation}}">
                <button type="submit" class="store-content__cat">詳しくみる</button>
            </form>
            <form action="{{ route('like.toggle') }}" method="post">
                @csrf
                <input type="hidden" name="store_id" value="{{$store->id}}">
                @if (Auth::check())
                @php
                    $liked = Auth::user()->likes()->where('store_id', $store->id)->exists();
                @endphp
                <button type="submit" class="like-button" style="color: {{ $liked ? 'red' : 'gray' }};">
                    <i class="fa-solid fa-heart"></i>
                </button>
                @else
                <button type="submit" class="like-button" disabled>
                    <i class="fa-solid fa-heart"></i>
                </button>
                @endif
            </form>
        </div>
    </div>
    @endif
    @endforeach
</div>
@endsection