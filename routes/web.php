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


Route::get('/', [BookController::class, 'index'])->name('index');
Route::get('/books', [BookController::class, 'books'])->name('books.index');
Route::post('/', [BookController::class, 'index'])->name('books.search');




Route::get('/register', [UserController::class, 'create'])->name('users.registerform');
Route::post('/register', [UserController::class, 'store'])->name('users.register');
Route::get('/login', [UserController::class, 'loginform'])->name('users.login');
Route::post('/login', [UserController::class, 'login'])->name('users.login.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');

Route::group(['middleware' => 'admin'], function () {
    

  Route::get('/admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard');
  Route::get('/admin/add_book', [BookController::class, 'addBookForm'])->name('admin.add_book');
  Route::post('/books', [BookController::class, 'store'])->name('admin.storeBook');
  Route::get('/admin/remove_book', [BookController::class, 'removeBookForm'])->name('admin.remove_book_form');
  Route::delete('/books', [BookController::class, 'destroy'])->name('admin.removeBook');
  Route::get('/admin/registeredusers', [UserController::class, 'showRegisteredUsers'])->name('admin.registeredusers');
  Route::get('/admin/book_show', [BookController::class, 'booksDetial'])->name('admin.book_show');
});



