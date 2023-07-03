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



Route::get('/register', [UserController::class, 'create'])->name('users.registerform');
Route::post('/register', [UserController::class, 'store'])->name('users.register');
Route::get('/login', [UserController::class, 'loginform'])->name('users.login');
Route::post('/login', [UserController::class, 'login'])->name('users.login.submit');
Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');

Route::group(['middleware' => 'admin'], function () {
    

  Route::get('/admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard');

});



