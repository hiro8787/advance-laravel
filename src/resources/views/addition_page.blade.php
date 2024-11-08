@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/addition_page.css') }}">
@endsection

@section('content')
<div class="addition-page">
    @if (session('status'))
        <div class="success">{{ session('status') }}</div>
    @endif
    <h1>店舗代表者作成ページ</h1>
    <div class="addition-content">
        <form action="/addition_create" method="POST">
            @csrf
            <div class="addition-content-item">
                <input class="addition-form" type="name" name="name" placeholder="代表者名"/>
                <input class="addition-form" type="email" name="email" placeholder="メールアドレス"/>
                <input class="addition-form" type="password" name="password" placeholder="パスワード"/>
            </div>
            <div class="addition-item">
                <button type="submit" class="addition-button">登録</button>
            </div>
        </form>
    <div>
</div>
@endsection