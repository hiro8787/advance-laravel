@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
    <div class='list-title'>口コミ一覧</div>
        <div class="list-all">
        @foreach($lists as $list)
        <div class="list" id="{{$list->id}}">
            <div class="list-img">
                <img class="list-img__item" src="{{$list->image}}" alt="" />
            </div>
            <p class="list-name">{{$list->name}}</p>
            <p class="list-name__tag">#{{$list->location}} #{{$list->category}}</p>
            <div class="list-content">
                <div>レビュー数☆{{$list->post}}</div>
            </div>
            <p class="list-description">{{$list->description}}</p>
            <form class="list-delete" action='list_delete' method="GET">
                <input type="hidden" name="id" value="{{ $list->id }}">
                <button type="submit" class="list-delete__button">口コミを削除する</button>
            </form>
        </div>
        @endforeach
    </div>
@endsection