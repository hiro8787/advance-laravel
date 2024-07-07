@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
@endsection

@section('content')
<div class="user">
    <h1>{{$user->name}}さん</h1>
    <div class="reservation">
        <h2 class="user-reservation">予約状況</h2>
        <div class="user-reservation__data">
            @foreach($reservations as $reservation)
            <div class="reservation-item">
                <p>Shop {{ $reservation->store->name }}</p>
                <p>Date {{ $reservation->reservation_date }}</p>
                <p>Time {{ $reservation->reservation_time }}</p>
                <p>Number {{ $reservation->people }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>



@endsection