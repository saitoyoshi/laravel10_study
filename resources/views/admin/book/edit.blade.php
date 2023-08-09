<x-layouts.book-manager>
    <x-slot:title>
        書籍更新
    </x-slot:title>
        <h1>書籍更新</h1>
        @if($errors->any())
        <x-alert class="danger">
            <x-error-messages :$errors />
        </x-alert>
        @endif

        <form action="{{ route('book.update', $book) }}" method="post">
            @csrf
            @method('PUT')
            <div>
                <label for="">カテゴリ</label>
                <select name="category_id" id="">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($category->id ==
                    old('category_id',$book->category_id))>
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
                <input type="text" name="price" value="{{  old('price', $book->price) }}">
            </div>
            <div>
                <label for="">著者</label>
                <ul>
                @foreach ($authors as $author)
                    <li>
                        <input type="checkbox" name="author_ids[]" value="{{ $author->id }}"
                        @checked(in_array($author->id, old('author_ids',$authorIds)))>
                        {{ $author->name }}
                    </li>
                @endforeach
            </ul>
            </div>
            <a href="{{ route('book.index') }}">戻る</a>
            <button>送信</button>
        </form>
    </x-layouts>
