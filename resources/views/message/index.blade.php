<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>勉強ようのサンプル</title>
</head>
<body>
    <main>
        <h1>メッセージ</h1>
        <form action="/messages" method="POST">
            @csrf
            <input type="text" name="body">
            <input type="submit" value="投稿">
        </form>
        <hr>
        <ul>
            @foreach ($messages as $message)
                <li>{{ $message->body }}</li>
            @endforeach
        </ul>
    </main>

</body>
</html>
