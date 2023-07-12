<x-layouts.book-manager>
    <x-slot:title>
        書籍更新
    </x-slot:title>

    <h1>書籍更新</h1>
    @if ($errors->any())
    <x-alert class="danger">
        <x-error-messages :errors="$errors" />
    </x-alert>
    @endif
    <form action="" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="">カテゴリ</label>
            <select name="category_id" id="">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(
                        $category->id == old('category_id', $book->category_id)
                    )>
                    {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">タイトル</label>
            <input type="text" name="title" value="{{ old('title', $book->title) }}">
        </div>
        <div>
            <label for="">価格</label>
            <input type="text" name="price" value="{{ old('price', $book->price) }}">
        </div>
        <div>
            <label for="">著者</label>
            <ul>
                @foreach ($authors as $author)

                <li>
                    <input type="checkbox" name="author_ids[]" id="" value="{{ $author->id }}" @checked(
                        in_array(
                            $author->id,
                            old('author_ids', $authorIds)
                            )
                            )>
                    {{ $author->name }}
                </li>
                @endforeach
            </ul>
        </div>
        <input type="submit" value="送信">
    </form>
</x-layouts.book-manager>
