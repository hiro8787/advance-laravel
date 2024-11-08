@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="addition-page">
    @if (session('status'))
        <div class="success">{{ session('status') }}</div>
    @endif
    <h1>管理者ページ</h1>
    <div class="addition-content">
        <form action="/addition_page" method="POST">
            @csrf
            <button class="addition-button">店舗代表者の作成</button>
        </form>
        <form action="/addition" >
            @csrf
            <button class="addition-button">店舗情報の追加</button>
        </form>
        <form action="/list">
            @csrf
            <button class="addition-button">口コミ一覧</button>
        </form>
    <div>
</div>
@endsection