@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="user">
    <h1>{{$user->name}}さん</h1>
    <div class="reservation">
        <h2 class="user-reservation">予約状況</h2>
        <div class="user-reservation__data">
            @foreach($reservations as $reservation)
            <form action="/delete" class="reservation-item">
                @csrf
                <div>
                    <i class="fa-regular fa-clock"></i>
                    予約 {{ $reservation->id}}
                    <button type="submit"><i class="fa-regular fa-circle-xmark"></i></button>
                </div>
                <p>Shop {{ $reservation->store->name }}</p>
                <p>Date {{ $reservation->reservation_date }}</p>
                <p>Time {{ substr($reservation->reservation_time, 0, 5) }}</p>
                <p>Number {{ $reservation->people }}</p>
            </form>
            @endforeach
        </div>
    </div>
</div>



@endsection