@extends('layouts.login_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
<h1>メールアドレスの確認が必要です</h1>
<p>メールアドレスを確認してください。確認メールが届いていない場合は、再送信してください。</p>
<form action="{{ route('verification.resend') }}" method="POST">
    @csrf
    <button type="submit">確認メールを再送信</button>
</form>
@endsection