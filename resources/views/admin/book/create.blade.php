<x-layouts.book-manager>
    <x-slot:title>
        書籍登録
    </x-slot:title>
        <h1>書籍登録</h1>
        <a href="{{ route('book.index') }}">戻る</a>
        @if($errors->any())
        <x-alert class="danger">
            <x-error-messages :$errors />
        </x-alert>
        @endif

        <form action="{{ route('book.store') }}" method="post">
            @csrf
            <x-book-form :$categories :$authors></x-book-form>
            <button>送信</button>
        </form>
    </x-layouts>
