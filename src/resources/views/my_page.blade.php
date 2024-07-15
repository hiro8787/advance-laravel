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
                @if($reservation)
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
                @endif
                @endforeach
            </div>
        </div>
        <div class="store">
            <h2 class="favorite-store">お気に入り店舗</h2>
            <div class ="favorite-store__list">
                @if($likes)
                @foreach($likes as $like)
                <div class ="favorite-store__content">
                    <div class="store-img">
                        <img class="store-img__item" src="{{$like->image}}" alt="" />
                    </div>
                    <div class="store-content">
                        <h3 class="store-name">{{ $like->name }}</h3>
                        <p class ="store-location">#{{ $like->location }}</P>
                        <p class ="store-category">#{{ $like->category }}</P>
                        <div class ="favorite-store__bottom">
                            <form action="/detail?id={{$like->store_id}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$like->store_id}}">
                                <input type="hidden" name="name" value="{{$like->name}}">
                                <input type="hidden" name="image" value="{{$like->image}}">
                                <input type="hidden" name="location" value="{{$like->location}}">
                                <input type="hidden" name="category" value="{{$like->category}}">
                                <input type="hidden" name="explanation" value="{{$like->explanation}}">
                                <button type="submit" class="store-content__category">詳しく見る</button>
                            </form>
                            <i class="fa-solid fa-heart"></i>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>



@endsection