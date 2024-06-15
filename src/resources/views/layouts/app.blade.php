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

<header class="title">
    <div class="menu">
        <span class="bar bar-top"></span>
        <span class="bar bar-middle"></span>
        <span class="bar bar-bottom"></span>
    </div>
    <div class="logo">Rese</div>
</header>
<body>
    <main>
        @yield('content')
    </main>
</body>
</html>