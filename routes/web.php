<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

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
        'post' => $post
        // 'comments' => 
    ]);
});


/*
    Menampilkan semua jenis kategori dari database
*/
// Route::get('/categories', function () {
//     $categories = Category::all(); // Ambil semua kategori dari database
//     return view('categories', [
//         'page' => 'All Categories',
//         'title' => 'All Categories',
//         'categories' => $categories, // Kirim daftar kategori ke view
//     ]);
// });
// Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories', function () {
    return view('categories', [
        'page' => 'All Categories',
        'title' => 'All Categories',
        //'categories' => 
    ]);
});


/*
    Menampilkan satu kategori serta menampilkan semua post
    dengan kategori tersebut, dan yang berstatus published
*/

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');


Route::get('/categories/{slug}', function (Category $category) {
    return view('category', [
        'page' => $category->category_name,
        'title' => $category->category_name,
        // 'posts' => 
    ]);
})->name('category.show');


/*
    Menampilkan profil user serta menampilkan semua post
    yang dibuat oleh user, dan yang berstatus published
*/
Route::get('/user/{user:username}', function (User $user) {
    return view('user', [
        'page' => $user->name,
        'title' => $user->name,
        // 'posts' =>
    ]);
});