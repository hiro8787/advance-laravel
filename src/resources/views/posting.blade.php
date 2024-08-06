@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="thanks">
    <div class="thanks-page">
        <p class="thanks-page__message">レビューありがとうございます</p>
        <form action='/' method="GET">
            @csrf
            <button class="button" type="submit">トップページ</button>
        </form>
    </div>
</div>
@endsection