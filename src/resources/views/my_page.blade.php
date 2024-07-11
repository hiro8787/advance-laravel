@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="user">
    <h1 class='user-name'>{{$user->name}}さん</h1>
    <div class="my_page">
        <div class="reservation">
            <h2 class="user-heading">予約状況</h2>
            <div class="user-reservation__data">
                @foreach($reservations as $reservation)
                <form action="/delete" class="reservation-item" method="GET">
                    @csrf
                    <div class="user-reservation">
                        <div class="reservation-title">
                            <i class="fa-regular fa-clock"></i>
                            <div class="reservation-number">予約 {{ $reservation->id}}</div>
                            <input type="hidden" name="id" value="{{ $reservation->id }}">
                            <button type="submit" class="delete-button"><i class="fa-regular fa-circle-xmark"></i></button>
                        </div>
                    </div>
                    <div class="reservation-all">
                        <div class="reservation-category">
                            <div class="reservation-category__title">Shop</div>
                            <div class="reservation-category__item">{{ $reservation->store->name }}</div>
                        </div>
                        <div class="reservation-category">
                            <div class="reservation-category__title">Date</div>
                            <div class="reservation-category__item">{{ $reservation->reservation_date }}</div>
                        </div>
                        <div class="reservation-category">
                            <div class="reservation-category__title">Time</div>
                            <div class="reservation-category__item">{{ substr($reservation->reservation_time, 0, 5) }}</div>
                        </div>
                        <div class="reservation-category">
                            <div class="reservation-category__title">Number</div>
                            <div class="reservation-category__item">{{ $reservation->people }}人</div>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
        <div class="store">
            <h2 class="favorite-store">お気に入り店舗</h2>
            @if($likes)
                @foreach($likes as $like)
                <img class="store-img" src="{{$like->image}}" alt="" />
                <h3 class="store-name">{{ $like->name }}</h3>
                @endforeach
            @endif
        </div>
    </div>
</div>



@endsection