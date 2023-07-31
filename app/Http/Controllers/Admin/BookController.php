<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Http\Requests\BookPutRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index(): Response
    {
        $books = Book::with('category')
        ->orderBy('category_id')
        ->orderBy('title')
        ->get();

        return response()
        ->view('admin.book.index', ['books' => $books])
        ->header('Content-Type', 'text/html')
        ->header('Content-Encoding', 'UTF-8');
    }
    public function show(Book $book): View
    {
        Log::info('書籍詳細情報が参照されました。ID=' . $book->id);
        return view('admin.book.show', compact('book'));
    }
    public function create(): View
    {
        $this->authorize('create', Book::class);
        $categories = Category::all();
        $authors = Author::all();

        return view('admin.book.create',compact('categories', 'authors'));
    }
    public function store(BookPostRequest $request): RedirectResponse
    {
        $this->authorize('create', Book::class);
        $book = new Book();

        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;
        $book->admin_id = Auth::id();

        DB::transaction(function () use ($book, $request) {
            $book->save();
            $book->authors()->attach($request->author_ids);
        });

        return redirect(route('book.index'))->with('message', $book->title . 'を追加しました');
    }
    public function edit(Book $book): View
    {
        // 作成者以外はアクセス不可にする
        $this->authorize('update', $book);
        $categories = Category::all();
        $authors = Author::all();
        $authorIds = $book->authors()->pluck('id')->all();

        return view('admin.book.edit', compact('book','categories', 'authors','authorIds'));
    }
    public function update(Book $book, BookPutRequest $request): RedirectResponse
    {
        $this->authorize('update', $book);
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;

        DB::transaction(function () use ($book, $request) {
            $book->update();
            $book->authors()->sync($request->author_ids);
        });

        return redirect(route('book.index'))->with('message', $book->title . 'を更新しました。');
    }
    public function destory(Book $book): RedirectResponse
    {
        $this->authorize('delete', $book);
        // カスケードしているので
        $book->delete();

        return redirect(route('book.index'))->with('message', $book->title . 'を削除しました。');
    }
}
