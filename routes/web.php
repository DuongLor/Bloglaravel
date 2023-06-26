<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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
//Home
Route::get('/',[HomeController::class,'index'])->name('home');
//Post
Route::get('/posts',[PostController::class,'index']);
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
//Đăng ký
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/register/verify/{token}', [RegisterController::class, 'verify'])->name('confirm_email');
//Đăng nhập
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
//Tìm kiếm
Route::get('/search', [PostController::class, 'search'])->name('search');