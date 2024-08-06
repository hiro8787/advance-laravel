<!DOCTYPE html>
<html>
<head>
    <title>予約リマインダー</title>
</head>
<body>
    <h1>予約リマインダー</h1>
    <p>ご予約日となりましたので予約内容をご確認の上、ご来店ください。</p>
    <p>予約店舗: {{ $reservation->name }}</p>
    <p>予約日: {{ $reservation->reservation_date }}</p>
    <p>予約時間: {{ substr($reservation->reservation_time, 0, 5)}}</p>
    <p>予約人数: {{ $reservation->people }}人</p>
    <p>ご不明な点がございましたら、お気軽にお問い合わせください。</p>
</body>
</html>