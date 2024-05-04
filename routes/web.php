<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;
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

Route::get('/', function () {
    return view('home', [
        'page' => 'Home',
        'title' => 'Home'
    ]);
});

Route::get('/posts', function () {
    return view('posts', [
        'page' => 'All Posts',
        'title' => 'All Posts',
        'posts' => Post::where('status', 'published')->get()
    ]);
});


/*
    Menampilkan komentar dari sebuah post
    dan menampilkannya sesuai urutan waktu
*/
Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', [
        'page' => $post->title,
        'post' => $post,
        'comments' => $post->comments()->orderBy('created_at', 'desc')->get()
    ]);
});


/*
    Menampilkan semua jenis kategori dari database
*/
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');



/*
    Menampilkan satu kategori serta menampilkan semua post
    dengan kategori tersebut, dan yang berstatus published
*/
Route::get('/categories/{category:category_slug}', [CategoryController::class, 'show'])->name('category.show');

/*
    Menampilkan profil user serta menampilkan semua post
    yang dibuat oleh user, dan yang berstatus published
*/
Route::get('/user/{user:username}', [UserController::class, 'show']);