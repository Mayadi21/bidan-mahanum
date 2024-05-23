<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;



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

Route::get('/banned', [HomeController::class, 'banned'])->name('banned');



Route::middleware('notBanned')->group(function () {
    
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('post.show');
    Route::get('/user/{user:username}', [PostController::class, 'user'])->name('post.user');
    
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/{category:category_slug}', [CategoryController::class, 'show'])->name('category.show');
});




Route::middleware(['auth', 'notBanned'])->group(function () {

    // Yuna
    Route::get('/posts/{post:slug}/report', [PostController::class, 'report'])->name('post.report');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
    // Yuna
    Route::post('/comment/{comment}/report', [CommentController::class, 'report'])->name('comment.report');

});



require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
