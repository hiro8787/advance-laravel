@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="addition-page">
    <h1>代表者ページ</h1>
    <div class="addition-content">
        <form class="addition-form" action="/addition">
            @csrf
            <button class="addition-button">店舗情報の作成</button>
        </form>
        <form class="addition-form" action="/store_all">
            @csrf
            <button class="addition-button">店舗情報の更新</button>
        </form>
        <form class='list' action="/reservation_status">
            @csrf
            <button class="addition-button">予約状況確認</button>
        </form>
    <div>
</div>
@endsection