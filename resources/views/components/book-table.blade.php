<table border="1">
    <tr>
        <th>カテゴリ</th>
        <th>タイトル</th>
        <th>価格</th>
        <th>更新</th>
        <th>削除</th>
    </tr>
@foreach ($books as $book)
    <tr @if($loop->even) style="background-color:#eee;"

    @endif>
        <td>{{ $book->category->title }}</td>
        <td>
            <a href="{{ route('book.show',$book) }}">{{ $book->title }}</a>
        </td>
        <td>{{ $book->price }}</td>
        <td>
            <a href="{{ route('book.edit',$book) }}">更新</a>
        </td>
        <td>
            <form action="{{ route('book.destory', $book) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="削除">
        </form>
        </td>
    </tr>
@endforeach
</table>
