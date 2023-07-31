<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Auth\Admin\AuthenticatedSessionController;
use App\Http\Controllers\MessageController;
use App\Models\Book;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('messages', [MessageController::class, 'index']);
Route::post('messages', [MessageController::class,'store']);

Route::prefix('admin')->group(function() {

    Route::name('admin.')
    ->controller(AuthenticatedSessionController::class)
    ->group(function() {
        Route::get('login', 'create')->name('create')->middleware('guest:admin');
        Route::post('login', 'store')->name('store')->middleware('guest:admin');
        Route::post('logout', 'destroy')->name('destroy')->middleware('auth:admin');
    });

    Route::prefix('books')
    ->name('book.')
    ->controller(BookController::class)
    ->middleware('auth:admin')
    ->group(function() {
        Route::get('', 'index')->name('index');
        Route::get('{book}', 'show')->whereNumber('book')->name('show');
        Route::get('create', 'create')->name('create')
        ->can('create', Book::class);
        Route::post('', 'store')->name('store')->can('create', Book::class);
        Route::get('{book}/edit', 'edit')->name('edit')->can('update', 'book');
        Route::put('{book}','update')->whereNumber('book')->name('update')->can('update', 'book');
        Route::delete('{book}', 'destory')->whereNumber('book')->name('destory')->can('delete', 'book');
    });
});
