<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;

// 1. Ruta principal → redirect a llibres
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('books.index');
    } else {
        return view('welcome');
    }
});

// 2. Dashboard → després del login
Route::get('/dashboard', function () {
    return redirect()->route('books.index');
})->middleware('auth')->name('dashboard');

// 3. Rutes d’usuaris autentificats
Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/show/{id}', [BookController::class, 'show'])->name('books.show');
    Route::get('/books/edit/{id}', [BookController::class, 'edit']);
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::get('/books/category/{id}', [BookController::class, 'showCategory'])->name('books.category');
    Route::get('/search-books', [BookController::class, 'search'])->name('books.search');


    // Crear review (formulari i store)
    Route::get('/books/{id}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/books/{id}/review', [ReviewController::class, 'store'])->name('reviews.store');

    // Perfil d’usuari
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Rutes protegides només per admin (IsAdmin)
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
    // Llibres: create, store, update, destroy
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/delete', [BookController::class, 'delete'])->name('books.delete');
    Route::delete('/books/destroy/{id}', [BookController::class, 'destroy'])->name('books.destroy');

    // Categories: index, create, store, edit, update, destroy
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/delete', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::delete('/categories/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // (Opcional) Reviews management
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/destroy/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Usuaris
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::delete('/users/destroy', [UserController::class, 'destroy'])->name('users.destroy');
});

// 5. Rutes d’autenticació Breeze/Jetstream
require __DIR__ . '/auth.php';
