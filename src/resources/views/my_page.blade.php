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
                <div class="reservation-content">
                    <form action="/delete" class="reservation-item" method="GET">
                        @csrf
                        <div class="reservation-title">
                            <i class="fa-regular fa-clock"></i>
                            <div class="reservation-number">予約 {{ $reservation->id}}</div>
                            <input type="hidden" name="id" value="{{ $reservation->id }}">
                            <button type="submit" class="delete-button"><i class="fa-regular fa-circle-xmark"></i></button>
                        </div>
                    </form>
                    <div class="reservation-all">
                        <table class="reservation-category">
                            <tr>
                            <th class="reservation-category__title">Shop</th>
                                <td class="reservation-category__item">{{ $reservation->store->name }}</td>
                            </tr>
                            <tr>
                                <th class="reservation-category__title">Date</th>
                                <td class="reservation-category__item">{{ $reservation->reservation_date }}</td>
                            </tr>
                            <tr>
                                <th class="reservation-category__title">Time</th>
                                <td class="reservation-category__item">{{ substr($reservation->reservation_time, 0, 5) }}</td>
                            </tr>
                            <tr>
                                <th class="reservation-category__title">Number</th>
                                <td class="reservation-category__item">{{ $reservation->people }}人</td>
                            </tr>
                        </table>
                        <div class="QrCode">{!! QrCode::generate(url('confirmation?id='.$reservation->id)) !!}
                            <div class="button">
                                <form action="/edit" class="edit" method="GET">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $reservation->id }}">
                                    <input type="hidden" name="name" value="{{ $reservation->store->name }}">
                                    <input type="hidden" name="reservation_date" value="{{ $reservation->reservation_date }}">
                                    <input type="hidden" name="reservation_time" value="{{ substr($reservation->reservation_time, 0, 5) }}">
                                    <input type="hidden" name="people" value="{{ $reservation->people }}">
                                    <button type="submit" class="edit-button"{{ strtotime($reservation->reservation_date . ' ' . $reservation->reservation_time) >= time() ? '' : 'disabled' }}>予約修正</button>
                                </form>
                                @if($review && strtotime($reservation->reservation_date . ' ' . $reservation->reservation_time) < time())
                                <form action="/review" class="review" method="GET">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $reservation->id }}">
                                    <input type="hidden" name="store_id" value="{{ $reservation->store_id }}">
                                    <button type="submit" class="review-button">レビュー</button>
                                </form>
                                @else
                                <div class="review-message">ご来店後にレビューをお願いします。</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('payment.create') }}" class="settlement">事前決済をする</a>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        <div class="store">
            <div class="favorite-all">
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
</div>
@endsection