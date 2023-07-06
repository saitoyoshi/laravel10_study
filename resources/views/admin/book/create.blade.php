<x-layouts.book-manager>
    <x-slot:title>
        書籍登録
    </x-slot:title>
<h1>書籍登録</h1>
        <x-alert >
            <x-error-messages :$errors />
        </x-alert>
        <form action={{ route('book.store') }} method="POST">
            @csrf
            <div>
                <label for="">カテゴリ</label>
                <select name="category_id" id="">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected($category->id === old('category_id'))>
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
                <input type="text" name="price" value="{{ old('price') }}">
            </div>
            <input type="submit" value="送信">
        </form>
    </x-layouts.book-manager>
