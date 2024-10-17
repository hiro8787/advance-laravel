@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/post_review.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="post-screen">
    <div class="post-review">
        @if ($existingPost)
        <div class="flash_message">
            {{ $message }}
        </div>
        @endif
        <img class="store-img" src="{{$store['image']}}" alt="" />
        <p class="store-name__tag">#{{$store->location}} #{{$store->category}}</p>
        <p>{{$store->explanation}}</p>
        <a href='/all_post' class="all-post">全ての口コミ情報</a>
        <div class="review-information">
            <form action="/post_edit" class="post" method="GET">
                @csrf
                <input type="hidden" name="id" value="{{$postId}}">
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="store_id" value="{{$store->id}}">
                <input type="hidden" name="name" value="{{$store->name}}">
                <input type="hidden" name="image" value="{{$store->image}}">
                <input type="hidden" name="location" value="{{$store->location}}">
                <input type="hidden" name="category" value="{{$store->category}}">
                <input type="hidden" name="explanation" value="{{$store->explanation}}">
                <button type="submit" class="edit-button">口コミを編集する</button>
            </form>
            <form action="/post_delete" class="post-item" method="GET">
                @csrf
                <input type="hidden" name="id" value="{{ $postId }}">
                <button type="submit" class="delete-button">口コミを削除する</button>
            </form>
        </div>
        <div class="star-rating">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $post_review)
                    <i class="fa-solid fa-star"></i>
                @else
                    <i class="fa-regular fa-star"></i>
                @endif
            @endfor
        </div>
        <p class="message">{{ optional($post)->description }}</p>
        @if(isset($user) && isset($store))
    </div>
    <div class="again-reservation">
        <div class="reservation">
            <h1 class="reservation-text">予約</h1>
            <form action="/done" class="reservation-item" method="POST">
                @csrf
                <input type="date" v-bind:min="today" min="{{ date('Y-m-d') }}" name="reservation_date" class="reservation-date" required value="{{old('date')}}">
                <input type="hidden" name="id" value="{{$store->id}}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="store_id" value="{{ $store->store_id }}">
                <input type="hidden" name="name" value="{{ $store->name }}">
                <input type="hidden" name="image" value="{{ $store->image }}">
                <input type="hidden" name="location" value="{{ $store->location }}">
                <input type="hidden" name="category" value="{{ $store->category }}">
                <input type="hidden" name="explanation" value="{{ $store->explanation }}">
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
                @endif
                <button class="reservation-button" type="submit">予約する</button>
            </form>
        </div>
        @else
        <p>予約情報を表示できません。</p>
        @endif
    </div>
</div>
@endsection
