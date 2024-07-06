@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class='thanks'>
    <div class='thanks-page'>
    <div class='thanks-page__message'>ご予約ありがとうございます</div>
    <form action='/detail' class='back' method="POST">
        @csrf
        
            <input type="hidden" name="name" value="{{$name}}">
            <input type="hidden" name="image" value="{{$image}}">
            <input type="hidden" name="location" value="{{$location}}">
            <input type="hidden" name="category" value="{{$category}}">
        <input type="hidden" name="explanation" value="{{$explanation}}">
        <input type="hidden" name="store_id" value="{{ $dates['store_id'] }}">
        <input type="hidden" name="reservation_date" value="{{ $dates['reservation_date'] }}">
        <input type="hidden" name="reservation_time" value="{{ $dates['reservation_time'] }}">
        <input type="hidden" name="people" value="{{ $dates['people'] }}">
        <button class="back-button" type="submit">戻る</button>
    </form>
</div>
</div>