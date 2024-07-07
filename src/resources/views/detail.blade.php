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
                <option value="time" disabled selected hidden>時間を選択</option>
                @foreach($times as $time)
                    @if(strtotime($time->param) >= strtotime('now'))
                    <option value="{{ $time->id }}" {{ old('time_id') == $time->id ? 'selected' : ''}}>{{$time->param}}</option>
                    @endif
                @endforeach
            </select></br>
            <select class="reservation-number" name="people">
                @foreach($numbers as $number)
                <option value="{{ $number->id }}" {{ old('counts_id') == $number->id ? 'selected' : ''}}>{{$number->number}}</option>
                @endforeach
            </select>
            <div class="reservation-content">
                <p class="reservation-content__category">Shop</p>
                <p class="reservation-content__category">Date</p>
                <p class="reservation-content__category">Time</p>
                <p class="reservation-content__category">Number</p>
            </div>
            <button class="reservation-button" type="submit">予約する</button>
        </form>
    </div>
</div>
@endsection