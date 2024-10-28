@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<div class="review">
    <div class="review-page">
        <h1 class="review-page__message">ご来店ありがとうございました。</h1>
        <h2 class="review-store">店舗名：{{ $name->store_name }}</h2>
        <form class="review-form" action='/posting' method="POST">
            @csrf
            <input type="hidden" name="date_id" value="{{$dateId}}">
            <h3 class="review-title">お店の総合評価</h3>
            <div class="review-content">
                <div class="review-content__form">
                    <div class="review-content__label">
                        <input type="radio" name="review" value="1" required>
                        <label for="1">1(不満)</label>
                    </div>
                    <div class="review-content__label">
                        <input type="radio" name="review" value="2" required>
                        <label for="2">2(やや不満)</label>
                    </div>
                    <div class="review-content__label">
                        <input type="radio" name="review" value="3" checked required>
                        <label for="3">3(まあまあ)</label>
                    </div>
                    <div class="review-content__label">
                        <input type="radio" name="review" value="4" required>
                        <label for="4">4(良かった)</label>
                    </div>
                    <div class="review-content__label">
                        <input type="radio" name="review" value="5" required>
                        <label for="5">5(凄く良かった)</label>
                    </div>
                </div>
                <textarea class="review-text"type="text" name="comment" cols="60" rows="10" placeholder="お店のご意見をお聞かせください。(最大255文字)"></textarea>
            </div>
            <button class="review-button" type="submit">レビュー送信</button>
        </form>
    </div>
</div>
@endsection