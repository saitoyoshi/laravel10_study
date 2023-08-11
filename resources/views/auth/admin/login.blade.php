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
        <x-alert class="danger">
            <x-error-messages :$errors />
        </x-alert>
    @endif
    <form action="{{ route('admin.create') }}" method="post">
    @csrf
    <div>
        <div>
            ログインID: <input type="text" name="login_id">
        </div>
        <div>
            パスワード: <input type="password" name="password">
        </div>
    </div>
    <div>
        <button>ログイン</button>
    </div>
</form>
</body>
</html>
