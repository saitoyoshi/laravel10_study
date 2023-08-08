<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <main>
        <h1>書籍登録</h1>
        <x-alert>
            <x-error-messages :$errors />
        </x-alert>
        <form action="{{ route('book.store') }}" method="post">
            @csrf
            <div>
                <label for="">カテゴリ</label>
                <select name="category_id" id="">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>
                        {{ $category->title }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="">タイトル</label>
                <input type="text" name="title" value="{{ old('title') }}">
            </div>
            <div>
                <label for="">価格</label>
                <input type="text" name="price" value="{{  old('price') }}">
            </div>
            <button>送信</button>
        </form>
    </main>
</body>
</html>
