<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if($errors->any())
        @foreach ($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>

        @endforeach
    @endif

    <form action="{{ route('messages.create') }}" method="POST">
        @csrf
        <label for="message">メッセージ：</label>
        <input type="text" name="message" id="message">
        <button>登録</button>
    </form>
    <hr>
    <ul>
        @foreach ($messages as $message)
        <li>
            {{ $message->body }}
            <a href="{{ route('messages.update', $message) }}">更新</a>
        </li>
        <li>
            <form action="{{ route('messages.destroy', $message) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </li>
        </form>
        @endforeach
    </ul>
</body>
</html>
