<?php

use App\Http\Controllers\ShelfController;
use App\Http\Controllers\vendor\Chatify\MessagesController;
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
Route::post('/', [BookController::class, 'index'])->name('books.search');

Route::group(['guest'],function (){
    Route::get('/register', [UserController::class, 'create'])->name('users.registerform');
    Route::post('/register', [UserController::class, 'store'])->name('users.register');
    Route::get('/login', [UserController::class, 'loginform'])->name('users.login');
    Route::post('/login', [UserController::class, 'login'])->name('users.login.submit');
});


Route::group(['auth'],function (){
    Route::post('/books', [BookController::class, 'books'])->name('bookss.search');
    Route::get('/books', [BookController::class, 'books'])->name('books.index');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/edit/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
    Route::get('/chatify',[MessagesController::class,'index'])->name('chatify');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/admin/registeredusers', [UserController::class, 'showRegisteredUsers'])->name('admin.registeredusers')->middleware('auth');
});

Route::group(['middleware' => ['admin', 'auth']], function () {

  Route::get('/admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard');
  Route::get('/admin/add_book', [BookController::class, 'addBookForm'])->name('admin.add_book');
  Route::post('/books/store', [BookController::class, 'store'])->name('admin.storeBook');
  Route::get('/admin/remove_book', [BookController::class, 'removeBookForm'])->name('admin.remove_book_form');
  Route::delete('/books', [BookController::class, 'destroy'])->name('admin.removeBook');
  Route::delete('/books/{book}', [BookController::class, 'deleteById'])->name('admin.removeBook');
  Route::get('/admin/edit_book/{book}', [BookController::class, 'editBookForm'])->name('admin.edit_book_form');
  Route::put('/books/{book}', [BookController::class, 'editBook'])->name('books.edit');
  Route::get('/admin/book_show', [BookController::class, 'booksDetail'])->name('admin.book_show');
  Route::get('/admin/borrowed-books', [UserController::class, 'viewBorrowedBooks'])->name('admin.borrowed-books');
  Route::get('/fines', [UserController::class, 'showFines'])->name('fines');
  Route::delete('/admin/delete-fines/{user}', [UserController::class, 'deleteFines'])->name('admin.deleteFines');
  Route::get('/shelves', [ShelfController::class, 'index'])->name('shelves.index');
  Route::get('/edit_shelf', [BookController::class,'editShelf'])->name('edit_shelf.page');
  Route::put('/edit_shelf', [BookController::class,'moveBook'])->name('edit_shelf');

});


Route::middleware(['user','auth'])->group(function () {
    // Routes that require the normal user middleware
    Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/follower_following', [UserController::class, 'follower_following'])->name('user.follower_following');
    Route::post('/user/{user}/follow', [UserController::class, 'follow'])->name('user.follow');
    Route::post('/user/{user}/unfollow', [UserController::class, 'unfollow'])->name('user.unfollow');
    Route::post('/books/{book}/borrow', [BookController::class, 'borrowBook'])->name('borrow');
    Route::post('/books/{book}/return', [BookController::class, 'returnBook'])->name('return');
    Route::get('/user/{user}/borrowed-books', [UserController::class, 'showBorrowedBooks'])->name('user.borrowedBooks');
    Route::get('/personal-shelf/{userId}', [UserController::class, 'showPersonalShelf'])->name('personal-shelf.show');
    Route::get('/user/fines/{userId}', [UserController::class, 'userFines'])->name('user.fines');
});




