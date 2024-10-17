@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/all_post.css') }}">
@endsection

@section('content')
<div class='post-title'>全てのレビュー</div>
    <div class="post-all">
        @foreach($posts as $post)
        <div class="post" id="{{$post->id}}">
            <div class="post-img">
                <img class="post-img__item" src="{{$post->image}}" alt="" />
            </div>
            <p class="post-name">{{$post->name}}</p>
            <p class="post-name__tag">#{{$post->location}} #{{$post->category}}</p>
            <div class="post-content">
                <div>レビュー数☆{{$post->post}}</div>
            </div>
            <p class="post-description">{{$post->description}}</p>
        </div>
        @endforeach
    </div>
@endsection