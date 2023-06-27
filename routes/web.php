<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommentAdminController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PostController as AdminPostController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{categoryId}/posts', [PostController::class, 'showByCategory'])->name('post.showByCategory');
//Post
Route::get('/posts', [PostController::class, 'index']);
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::get('/detail/{postId}', [PostController::class, 'detail'])->name('post.detail');
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

//middleware
Route::group(['middleware' => ['auth']], function () {
	Route::get('/post', [PostController::class, 'index'])->name('post.index');
	Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
	Route::post('/post', [PostController::class, 'store'])->name('post.store');
	Route::post('/post/upload', [PostController::class, 'upload'])->name('ckeditor.upload');

	Route::group(['middleware' => ['checkPostAccess']], function () {
		Route::get('/post/{post}/show', [PostController::class, 'show'])->name('post.show');
		Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
		Route::put('/post/{post}', [PostController::class, 'update'])->name('post.update');
		Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
	});
	Route::post('/comment/{postId}/store', [CommentController::class, 'store'])->name('comment.store');
  Route::post('/comment/{commentId}', [CommentController::class, 'reply'])->name('comment.reply');

	Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
  Route::put('/profile/{profileId}', [ProfileController::class, 'update'])->name('profile.update');
});

//admin

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']],function(){
	Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');
  Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
  Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
  Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
  Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
  Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
  Route::get('/comment', [CommentAdminController::class, 'index'])->name('comment.index');
  Route::get('/comment/{comment_id}', [CommentAdminController::class, 'show'])->name('admin.comment.show');
  Route::post('/comment/{comment_id}', [CommentAdminController::class, 'reply'])->name('admin.comment.reply');
  Route::get('/browse', [AdminPostController::class, 'browse'])->name('admin.browse');
  Route::post('/post/feature/{postId}', [AdminPostController::class, 'feature'])->name('admin.post.feature');
  Route::post('/post/status/{postId}', [AdminPostController::class, 'status'])->name('admin.post.status');
  Route::get('/post', [AdminPostController::class, 'index'])->name('admin.post.index');
  Route::get('/post/{id}/show', [AdminPostController::class, 'show'])->name('admin.post.show');
  Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
  Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
});


