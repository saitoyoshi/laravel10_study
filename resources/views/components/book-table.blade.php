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
            @can('update', $book)
            <a href="{{ route('book.edit',$book) }}"><button>更新</button></a>
            @else
            <button disabled>更新</button>
            @endcan
        </td>
        <td>
            @cannot('update', $book)
                <button disabled>削除</button>
            @else
                <form action="{{ route('book.destroy', $book) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除">
                </form>
            @endcannot
        </td>
    </tr>
@endforeach
</table>
