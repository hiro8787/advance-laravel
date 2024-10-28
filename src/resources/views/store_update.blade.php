@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_update.css') }}">
@endsection

@section('content')
<div class="title">店舗情報更新ページ</div>
<aside>
    <p class="title_aside">更新する店舗を選択してください。</p>
</aside>
<div class="store-all">
    @foreach($stores as $store)
    <div class="store" id="{{$store->id}}">
        <div class="store-img">
            <img class="store-img__item" src="{{$store->image}}" alt="" />
        </div>
        <p class="store-name">{{$store->store_name}}</p>
        <p class="store-name__tag">#{{$store->location}} #{{$store->category}}</p>
        <div class="store-content">
            <form action="/update" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$store->id}}">
                <input type="hidden" name="store_name" value="{{$store->store_name}}">
                <input type="hidden" name="image" value="{{$store->image}}">
                <input type="hidden" name="location" value="{{$store->location}}">
                <input type="hidden" name="category" value="{{$store->category}}">
                <input type="hidden" name="explanation" value="{{$store->explanation}}">
                <button type="submit" class="store-content__cat">店舗情報の更新</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection