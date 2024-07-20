@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="edit">
    <div class="edit-content">
<h1 class="edit-title">予約変更</h1>
<form class="edit-item" action="/edit" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="hidden" name="name" value="{{ $name }}">
    <table class="edit-screen">
        <tr class ="edit-screen__content">
            <th class="edit-category">予約{{ $id }}</th>
        </tr>
        <tr class="edit-screen__content">
            <th class="edit-category">Shop</th>
            <td class="edit-category__item">{{ $name }}</td>
        </tr>
        <tr class="edit-screen__content">
            <th class="edit-category">Date</th>
            <td class="edit-category__item">
                <input type="date" v-bind:min="today" min="{{ date('Y-m-d') }}" name="reservation_date" class="reservation" required value="{{old('date')}}">
            </td>
        </tr>
        <tr class="edit-screen__content">
            <th class="edit-category">Time</th>
            <td class="edit-category__item">
                <select class="reservation" name="reservation_time" value="{{ old('reservation_time') }}">
                <option disabled selected hidden>時間を選択</option>
                @foreach($times as $time)
                    <option value="{{ $time->param }}" {{ old('reservation_time') == $time->param ? 'selected' : ''}}>{{ $time->param }}</option>
                @endforeach
            </select>
            @error('reservation_time')
                <div class="error">{{ $message }}</div>
            @enderror
            </td>
        </tr>
        <tr class="edit-screen__content">
            <th class="edit-category">Number</th>
            <td class="edit-category__item">
                <select class="reservation" name="people">
                @foreach($numbers as $number)
                <option value="{{ $number->id }}" {{ old('counts_id') == $number->id ? 'selected' : ''}}>{{$number->number}}</option>
                @endforeach
                </select>
            </td>
        </tr>
    </table>
    <button type="submit" class="edit-button">変更確定</button>
</form>
</div>
</div>
@endsection