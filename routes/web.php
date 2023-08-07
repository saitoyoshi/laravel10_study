<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/messages')->controller(MessageController::class)->name('messages.') ->group(function () {
    Route::get('', 'index')->name('index');
    Route::post('/create', 'store')->name('create');
    Route::get('/update/{message}','update')->name('update');
    Route::put('/update/edit/{message}', 'edit')->name('edit');
    Route::delete('/{message}', 'delete')->name('destroy');
});

Route::get('admin/books', [BookController::class, 'index'])->name('book.index');
Route::get('admin/books/{id}', [BookController::class, 'show'])->whereNumber('id')->name('book.show');
