@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="thanks">
    <div class="thanks-page">
        <p class="thanks-page__message">会員登録ありがとうございます</p>
        <form action='/login' method="GET">
            @csrf
            <button class="button" type="submit">ログインする</button>
        </form>
    </div>
</div>
@endsection