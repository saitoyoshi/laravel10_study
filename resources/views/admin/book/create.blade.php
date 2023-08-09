<x-layouts.book-manager>
    <x-slot:title>
        書籍登録
    </x-slot:title>
        <h1>書籍登録</h1>
        @if($errors->any())
        <x-alert class="danger">
            <x-error-messages :$errors />
        </x-alert>
        @endif

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
            <div>
                <label for="">著者</label>
                <ul>
                @foreach ($authors as $author)
                    <li>
                        <input type="checkbox" name="author_ids[]" value="{{ $author->id }}"
                        @checked(is_array(old('author_ids'))
                        &&
                        in_array($author->id, old('author_ids')))>
                        {{ $author->name }}
                    </li>
                @endforeach
            </ul>
            </div>
            <button>送信</button>
        </form>
    </x-layouts>
