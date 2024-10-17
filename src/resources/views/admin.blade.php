@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="addition-page">
    <h1>管理者ページ</h1>
    <div class="addition-content">
        <form class="addition-form" action="/addition" >
            @csrf
            <button class="addition-button">店舗情報の追加</button>
        </form>
        <form class='list' action="/list">
            @csrf
            <button class="addition-button">口コミ一覧</button>
        </form>
    <div>
</div>
@endsection