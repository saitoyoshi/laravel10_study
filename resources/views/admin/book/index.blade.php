<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>一覧ページ</title>
</head>
<body>
    <main>
    <h1>書籍一覧</h1>
    @if(session('message'))
    <div style="color:green">{{ session('message') }}</div>
    @endif
    <a href="{{ route('book.create') }}">追加</a>
  <x-book-table :$books />
</main>
</body>
</html>
