<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <div class="menu-container">
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="menu-button">
            <span class="bar-top"></span>
            <span class="bar-middle"></span>
            <span class="bar-bottom"></span>
        </label>
        <div class="logo">Rese</div>
        <nav class="menu">
            <ul class="menu-list">
                @if (Auth::check())
                <li><a class="menu-item" href="/">Home</a></li>
                <form class="menu-item" method="POST" action="/logout">
                    @csrf
                    <button class="menu-item-button" type="submit">Logout</button>
                </form>
                <li><a class="menu-item" href="/my_page">Mypage</a></li>
                @else
                <li><a class="menu-item" href="/">Home</a></li>
                <li><a class="menu-item" href="/register">Registration</a></li>
                <li><a class="menu-item" href="/login">Login</a></li>
                @endif
            </ul>
        </nav>
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>