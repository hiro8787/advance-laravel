@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="shop">
    <div class="shop-detail">
        <div class="detail-content">
            <form action="/" class="home">
                <button class="detail-button"><</button>
            </form>
            <h2 class="detail-name">{{$name}}</h2>
        </div>
        <img src="{{$image}}" alt="" class="detail-img">
        <div class="detail-location">#{{$location}} #{{$category}}</div>
        <div class="explanation">{{$explanation}}</div>
    </div>
    <div class="reservation">
        <h1 class="reservation-text">予約</h1>
        <form action="/done" class="reservation-item" method="POST">
            @csrf
            <input type="date" v-bind:min="today" min="{{ date('Y-m-d') }}" name="reservation_date" class="reservation-date" required value="{{old('date')}}">
            <input type="hidden" name="user_id" value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : ''}}>
            <input type="hidden" name="store_id" value="{{ $stores->id }}" {{ old('store_id') == $stores->id ? 'selected' : ''}}>
            <select class="reservation-time" name="reservation_time">
                <option disabled selected hidden>時間を選択</option>
                @foreach($times as $time)
                    <option value="{{ $time->param }}" {{ old('time_param') == $time->param ? 'selected' : ''}}>{{ $time->param }}</option>
                @endforeach
            </select></br>
            <select class="reservation-number" name="people">
                @foreach($numbers as $number)
                <option value="{{ $number->id }}" {{ old('counts_id') == $number->id ? 'selected' : ''}}>{{$number->number}}</option>
                @endforeach
            </select>
            @isset($detail)
            <div class="reservation-content">
                <div class="reservation-content__item">
                    <div class="reservation-content__category">Shop</div>
                    <div class="reservation-content__information">{{ $reservation->name }}</div>
                </div>
                <div class="reservation-content__item">
                    <div class="reservation-content__category">Date</div>
                    <div class="reservation-content__information">{{ $reservation->reservation_date }}</div>
                </div>
                <div class="reservation-content__item">
                    <div class="reservation-content__category">Time</div>
                    <div class="reservation-content__information">{{ substr($reservation->reservation_time, 0, 5) }}</div>
                </div>
                <div class="reservation-content__item">
                    <div class="reservation-content__category">Number</div>
                    <div class="reservation-content__information">{{ $reservation->people }}人</div>
                </div>
            </div>
            @endisset
            @if(!$detail)
            <button class="reservation-button" type="submit">予約する</button>
            @endif
        </form>
    </div>
</div>
@endsection