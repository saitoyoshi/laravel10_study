<table border="1">
    <tr>
        <th>カテゴリ</th>
        <th>書籍名</th>
        <th>価格</th>
        <th>更新</th>
        <th>削除</th>
    </tr>
    @foreach ($books as $book)

    <tr @if ($loop->even) style="background:#eee" @endif>
        <td>{{ $book->category->title }}</td>
        <td><a href="{{ route('book.show', $book) }}"> {{ $book->title }}</a></td>
        <td>{{ $book->price }}</td>
        <td><a href="{{ route('book.edit', $book) }}"><button>更新</button></a></td>
        <td>
            <form action="{{ route('book.destroy', $book) }}" method="post">
                @csrf
                @method('DELETE')
            <button>削除</button>
        </form>
        </td>
    </tr>
    @endforeach
</table>
