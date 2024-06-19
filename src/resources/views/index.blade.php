<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<header class="menu-container">
    <input type="checkbox" id="menu-toggle">
    <label for="menu-toggle" class="menu-button">
        <span class="bar-top"></span>
        <span class="bar-middle"></span>
        <span class="bar-bottom"></span>
    </label>
    <div class="logo">Rese</div>
    <nav class="menu">
        <ul class="menu-list">
            <li><a class="menu-item" href="#">Home</a></li>
            <li><a class="menu-item" href="#">Logout</a></li>
            <li><a class="menu-item" href="#">Mypage</a></li>
        </ul>
    </nav>
</header>


<body>
    <div class="store">
        <div class="store__img">
        <img src='https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg'>
        </div>
    </div>
    <h2 class="store-name">仙人</h2>
    <p>#東京都 #寿司</p>
    <div class="store__content">
        <div class="store__content-cat">詳しく見る</div>
    </div>
</body>

</html>