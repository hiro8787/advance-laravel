@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_status.css') }}">
@endsection

@section('content')
<div class="reservation">
    <div class="title">予約状況一覧</div>
    @foreach($reserves as $reserve)
    <div class="reservation_item">
        <table class="reservation_list">
            <tr>
                <th class="reservation_title">名前</th>
                <td class="reservation_category">{{ $reserve->name }}様</td>
            </tr>
            <tr>
                <th class="reservation_title">店舗名</th>
                <td class="reservation_category">{{ $reserve->store_name }}</td>
            </tr>
            <tr>
                <th class="reservation_title">予約日</th>
                <td class="reservation_category">{{ $reserve->reservation_date }}</td>
            </tr>
            <tr>
                <th class="reservation_title">予約時間</th>
                <td class="reservation_category">{{ $reserve->reservation_time }}</td>
            </tr>
            <tr>
                <th class="reservation_title">予約人数</th>
                <td class="reservation_category">{{ $reserve->people }}名</td>
            </tr>
        </table>
    </div>
    @endforeach
    {{ $reserves->links('vendor.pagination.default') }}
</div>
@endsection