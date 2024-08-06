<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <title>Confirmation</title>
</head>
<body>
    <h1>予約確認</h1>
    <p>店舗名: {{ $reservation->store->name }}</p>
    <p>ユーザー名: {{ $reservation->user->name }}様</p>
    <p>予約日時: {{ $reservation->reservation_date }} {{ substr($reservation->reservation_time, 0, 5) }}</p>
    <p>予約人数: {{ $reservation->people }}人</p>
</body>
</html>