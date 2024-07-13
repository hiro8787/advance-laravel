@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="thanks">
    <div class="thanks-page">
        <p class="thanks-page__message">ご予約ありがとうございます</p>
        <form action='/detail' method="POST">
            @csrf
            <input type="hidden" name="name" value="{{ $reservation->name}}">
            <input type="hidden" name="image" value="{{ $reservation->image}}">
            <input type="hidden" name="location" value="{{ $reservation->location}}">
            <input type="hidden" name="category" value="{{ $reservation->category}}">
            <input type="hidden" name="explanation" value="{{ $reservation->explanation}}">
            <input type="hidden" name="id" value="{{ $reservation->id }}">
            <input type="hidden" name="user_id" value="{{ $reservation->user_id }}">
            <input type="hidden" name="store_id" value="{{ $reservation->store_id }}">
            <input type="hidden" name="reservation_date" value="{{ $reservation->reservation_date }}">
            <input type="hidden" name="reservation_time" value="{{ $reservation->reservation_time }}">
            <input type="hidden" name="people" value="{{ $reservation->people }}">
            <button class="button" type="submit">戻る</button>
        </form>
    </div>
</div>