@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/store_edit.css') }}">
@endsection

@section('content')
<div class="title">店舗情報更新ページ</div>
<div class="store-all">
    <div class="store">
        <div class="store-img">
            <img class="store-img__item" src="{{ old('image', $image) }}" alt="" />
        </div>
        <p class="store-name">{{ old('name', $name) }}</p>
        <p class="store-name__tag">#{{ old('location', $location) }} #{{ old('category', $category) }}</p>
        <P class="store-explanation">{{ old('explanation', $explanation) }}</p>
    </div>
    <div class="store-content">
        <form action="/store_update" method="post" enctype="multipart/form-data">
            @csrf
            <input class="store-file" type="file" name="image" accept="image/png,image/jpeg"></br>
            <input type="hidden" name="image" value="{{ old('image', $image) }}">
            <input type="hidden" name="name" value="{{ old('name', $name) }}">
            <input type="hidden" name="location" value="{{ old('location', $location) }}">
            <input type="hidden" name="category" value="{{ old('category', $category) }}">
            <input type="hidden" name="id" value="{{ $form }}">
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
                <textarea class="store-message-form" name="explanation" cols="60" rows="5" value="店舗の紹介メッセージを記入">{{ old('explanation', $explanation) }}</textarea>
            </div>
            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="store-content__cat">店舗情報の更新</button>
        </form>
    </div>
</div>
@endsection