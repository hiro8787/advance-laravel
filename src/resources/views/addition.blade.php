@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/addition.css') }}">
@endsection

@section('content')
<div class="addition">
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    <div class="import">
        <h1>店舗追加ページ</h1>
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <input class="file" type="file" name="csv_file" >
            <h2>CSVファイルをインポート</h2>
            @error('csv_file')
            <div class="error">{{ $message }}</div>
            @enderror
            <button class="submit" type="submit">店舗情報登録</button>
        </form>
    <div>
</div>
@endsection