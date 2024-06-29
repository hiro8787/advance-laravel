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
        <form action="" class="reservation-item">
            @csrf
            <input type="date" name="reservation-date" class="reservation-date" required value="{{old('date')}}"></br>
            <select class="reservation-time" name="time_id" id="">
                <option value="time" disabled selected hidden>時間を選択</option>
                @foreach($dates as $date)
                <option value="{{ $date->id }}" {{ old('time_id') == $date->id ? 'selected' : ''}}>{{$date->param}}</option>
                @endforeach
            </select></br>
            <select class="reservation-number" name="count_id" id="">
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
            <input type="hidden" name="name" value="{{$name}}">
            <input type="hidden" name="image" value="{{$image}}">
            <input type="hidden" name="location" value="{{$location}}">
            <input type="hidden" name="category" value="{{$category}}">
            <input type="hidden" name="explanation" value="{{$explanation}}">
            <button class="reservation-button" type="submit">予約する</button>
        </form>
    </div>
</div>