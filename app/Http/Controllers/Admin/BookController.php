<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class BookController extends Controller
{
    public function index(): Collection
    {
        $books = Book::all();

        return $books;
    }
    public function show(string $id): Book
    {
        $book = Book::findOrFail($id);

        return $book;
    }
    public function create(): View
    {
        $categories = Category::all();

        return view('admin.book.create',[
            'categories' => $categories
        ]);
    }
    public function store(BookPostRequest $request): Book
    {
        $book = new Book();

        $book->category_id = $request->category_id;
        $book->title = $request->title;
        $book->price = $request->price;

        $book->save();

        return $book;
    }
}
