<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Dashboard\PostsController as DashboardPostsController;
use App\Http\Controllers\Dashboard\CategoriesController as DashboardCategoriesController;


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
    return view('blog.home', [
        'page' => 'Home',
        'title' => 'Home'
    ]);
});



Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/user/{user:username}', [PostController::class, 'user']);



Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/{category:category_slug}', [CategoryController::class, 'show'])->name('category.show');



Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('/profile/', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');



Route::resource('/dashboard/posts', DashboardPostsController::class)->middleware('auth');



Route::resource('/dashboard/categories', DashboardCategoriesController::class)->except('show')->middleware(['auth', 'admin']);



Route::post('/comment', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');
Route::delete('/comment', [CommentController::class, 'destroy'])->name('comment.destroy')->middleware('auth');



Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate')->middleware('guest');



Route::get('/register', [RegisterController::class, 'index'])->name('register.index')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store')->middleware('guest');