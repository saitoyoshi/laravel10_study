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
    <form action="{{ route('messages.edit', $message) }}" method="post">
        @csrf
        @method('PUT')
        <label for="">メッセージ</label>
        <input type="text" name="body" value="{{ old('body',$message->body)  }}">

        <button type="submit">更新</button>
    </form>
</body>
</html>
