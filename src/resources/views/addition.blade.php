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
            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button class="submit" type="submit">店舗情報登録</button>
        </form>
    <div>
</div>
@endsection