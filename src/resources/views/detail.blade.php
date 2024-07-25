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
            <h2 class="detail-name">{{ old('name', $name) }}</h2>
        </div>
        <img src="{{ old('image', $image) }}" alt="" class="detail-img">
        <p>#{{ old('location', $location) }} #{{ old('category', $category) }}</p>
        <p>{{ old('explanation', $explanation) }}</p>
    </div>
    <div class="reservation">
        <h1 class="reservation-text">予約</h1>
        <form action="/done" class="reservation-item" method="POST">
            @csrf
            <input type="date" v-bind:min="today" min="{{ date('Y-m-d') }}" name="reservation_date" class="reservation-date" required value="{{old('date')}}">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="store_id" value="{{ old('store_id', $detail) }}">
            <input type="hidden" name="name" value="{{ old('name', $name) }}">
            <input type="hidden" name="image" value="{{ old('image', $image) }}">
            <input type="hidden" name="location" value="{{ old('location', $location) }}">
            <input type="hidden" name="category" value="{{ old('category', $category) }}">
            <input type="hidden" name="explanation" value="{{ old('explanation', $explanation) }}">
            <select class="reservation-time" name="reservation_time" value="{{ old('reservation_time') }}">
                <option disabled selected hidden>時間を選択</option>
                @foreach($times as $time)
                    <option value="{{ $time->param }}" {{ old('reservation_time') == $time->param ? 'selected' : ''}}>{{ $time->param }}</option>
                @endforeach
            </select>
            @error('reservation_time')
                <div class="error">{{ $message }}</div>
            @enderror
            <select class="reservation-number" name="people">
                @foreach($numbers as $number)
                <option value="{{ $number->id }}" {{ old('counts_id') == $number->id ? 'selected' : ''}}>{{$number->number}}</option>
                @endforeach
            </select>
            @if($reservation)
            @isset($detail)
            <table class="reservation-content">
                <tr class="reservation-content__item">
                    <th class="reservation-content__category">Shop</th>
                    <td class="reservation-content__information">{{ $reservation->name }}</td>
                </tr>
                <tr class="reservation-content__item">
                    <th class="reservation-content__category">Date</th>
                    <td class="reservation-content__information">{{ $reservation->reservation_date }}</td>
                </tr>
                <tr class="reservation-content__item">
                    <th class="reservation-content__category">Time</th>
                    <td class="reservation-content__information">{{ substr($reservation->reservation_time, 0, 5) }}</td>
                </tr>
                <tr class="reservation-content__item">
                    <th class="reservation-content__category">Number</th>
                    <td class="reservation-content__information">{{ $reservation->people }}人</td>
                </tr>
            </table>
            @endisset
            @endif
            <button class="reservation-button" type="submit">予約する</button>
        </form>
    </div>
</div>
@endsection