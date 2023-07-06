<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

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




Route::post('/books', [BookController::class, 'books'])->name('bookss.search');
Route::get('/books', [BookController::class, 'books'])->name('books.index');
Route::get('/', [BookController::class, 'index'])->name('index');
Route::post('/', [BookController::class, 'index'])->name('books.search');



Route::get('/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/edit/{user}', [UserController::class, 'update'])->name('users.update');

Route::get('/register', [UserController::class, 'create'])->name('users.registerform');
Route::post('/register', [UserController::class, 'store'])->name('users.register');
Route::get('/login', [UserController::class, 'loginform'])->name('users.login');
Route::post('/login', [UserController::class, 'login'])->name('users.login.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');



Route::group(['middleware' => 'admin'], function () {
    

  Route::get('/admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard');
  Route::get('/admin/add_book', [BookController::class, 'addBookForm'])->name('admin.add_book');
  Route::post('/books/store', [BookController::class, 'store'])->name('admin.storeBook');
  Route::get('/admin/remove_book', [BookController::class, 'removeBookForm'])->name('admin.remove_book_form');
  Route::delete('/books', [BookController::class, 'destroy'])->name('admin.removeBook');
  Route::delete('/books/{book}', [BookController::class, 'deleteById'])->name('admin.removeBook');
  Route::get('/admin/edit_book/{book}', [BookController::class, 'editBookForm'])->name('admin.edit_book_form');
  Route::put('/books/{book}', [BookController::class, 'editBook'])->name('books.edit');
  Route::get('/admin/registeredusers', [UserController::class, 'showRegisteredUsers'])->name('admin.registeredusers');
  Route::get('/admin/book_show', [BookController::class, 'booksDetial'])->name('admin.book_show');



});



Route::middleware(['user'])->group(function () {
    // Routes that require the normal user middleware
    Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/admin/registeredusers', [UserController::class, 'showRegisteredUsers'])->name('admin.registeredusers');

});




