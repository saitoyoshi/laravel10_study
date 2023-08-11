<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Auth\Admin\AuthenticatedSessionController;
use App\Http\Controllers\Admin\BookController;

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

Route::prefix('/messages')->controller(MessageController::class)->name('messages.') ->group(function () {
    Route::get('', 'index')->name('index');
    Route::post('/create', 'store')->name('create');
    Route::get('/update/{message}','update')->name('update');
    Route::put('/update/edit/{message}', 'edit')->name('edit');
    Route::delete('/{message}', 'delete')->name('destroy');
});

Route::prefix('admin')->group(function() {

    Route::name('admin.')->controller(AuthenticatedSessionController::class)->group(function() {
        Route::get('login', 'create')->name('create');
        Route::post('login', 'store')->name('store');
        Route::post('logout', 'destroy')->name('destroy');
    });

    Route::prefix('books')->controller(BookController::class)->name('book.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/{book}', 'show')->whereNumber('book')->name('show');
        Route::get('create', 'create')->name('create');
        Route::post('', 'store')->name('store');
        Route::get('/{book}/edit', 'edit')->whereNumber('book')->name('edit');
        Route::put('/{book}', 'update')->whereNumber('book')->name('update');
        Route::delete('/{book}', 'destroy')->whereNumber('book')->name('destroy');
    });
});
