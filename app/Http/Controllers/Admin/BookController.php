<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View {
        $books = Book::with('category')->orderBy('category_id')->orderBy('title')->get();
        return view('admin.book.index', compact('books'));
    }
    public function show(Book $book): View {

        return view('admin.book.show', compact('book'));
    }
    public function create(): View {
        $categories = Category::all();
        return view('admin.book.create', compact('categories'));
    }
    public function store(BookPostRequest $request): RedirectResponse {
        $book = new Book();
        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;

        $book->save();
        return redirect(route('book.index'))->with('message', $book->title . 'を登録しました');
    }
}
