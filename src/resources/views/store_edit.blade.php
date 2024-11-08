@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_edit.css') }}">
@endsection

@section('content')
<div class="title">店舗情報更新ページ</div>
<div class="store-all">
    <div class="store">
        <div class="store-img">
            <img class="store-img__item" src="{{ $store->image }}" alt="" />
        </div>
        <p class="store-name">{{ $store->store_name }}</p>
        <p class="store-name__tag">#{{ $store->location }} #{{ $store->category }}</p>
        <P class="store-explanation">{{ $store->explanation }}</p>
    </div>
    <div class="store-content">
        <form action="/store_update" method="post" enctype="multipart/form-data">
            @csrf
            <input class="store-file" type="file" name="image" accept="image/png,image/jpeg"></br>
            <input type="hidden" name="id" value="{{ $store->id }}">
            <div class="store-content__tag">
            <input  class="store-text" type="text" name="store_name" >
            <select class="store-location" name="location">
                @foreach($items->unique('location') as $item)
                    <option>{{ $item->location }}</option>
                @endforeach
            </select>
            <select class="store-category" name="category">
                @foreach($items->unique('category') as $item)
                    <option>{{ $item->category }}</option>
                @endforeach
            </select>
            </div>
            <div class="store-message">
                <textarea class="store-message-form" name="explanation" cols="60" rows="5" value="店舗の紹介メッセージを記入"></textarea>
            </div>
            <button type="submit" class="store-content__cat">店舗情報の更新</button>
        </form>
    </div>
</div>
@endsection