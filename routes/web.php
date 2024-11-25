<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\PostsController as DashboardPostsController;
use App\Http\Controllers\Dashboard\CommentsController as DashboardCommentsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\AdminUsersController;
use App\Http\Controllers\Dashboard\AdminPostsController; 
use App\Http\Controllers\Dashboard\AdminReportsController;
use App\Http\Controllers\Dashboard\AdminCommentsController;
use App\Http\Controllers\Dashboard\AdminDashboardController; 
use App\Http\Controllers\Dashboard\AdminCategoriesController;
use App\Http\Controllers\Dashboard\AdminPostReportsController;
use App\Http\Controllers\Dashboard\AdminCommentReportsController;
use App\Http\Controllers\Dashboard\LayananController;
use App\Http\Controllers\Dashboard\AdminJanjiTemuController;
use App\Http\Controllers\Dashboard\AdminTransaksiController;
use App\Http\Controllers\Dashboard\AdminUlasanController;


Route::get('/banned', [HomeController::class, 'banned'])->name('banned');

Route::middleware('notBanned')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');

    // Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    // Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('post.show');
    // Route::get('/user/{user:username}', [PostController::class, 'user'])->name('post.user');
    
    // Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    // Route::get('/categories/{category:category_slug}', [CategoryController::class, 'show'])->name('category.show');
});

Route::middleware(['auth', 'notBanned'])->group(function () {

    // Route::post('/posts/{post:slug}/report', [PostController::class, 'report'])->name('post.report');

    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    // Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::post('/profile/', [ProfileController::class, 'update'])->name('profile.update');

    // Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    // Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

    // Route::post('/comment/{comment}/report', [CommentController::class, 'report'])->name('comment.report');

});

Route::middleware(['auth', 'notBanned'])->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/posts', DashboardPostsController::class);
        
        // Route::get('/comments', [DashboardCommentsController::class, 'index'])->name('dashboard.comments.index');
        // Route::get('/comments/{comment:id}', [DashboardCommentsController::class, 'show'])->name('dashboard.comments.show');
        // Route::put('/comments/{comment:id}', [DashboardCommentsController::class, 'report'])->name('dashboard.comments.report');
        
        Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
        Route::get('/layanan/{id}', [LayananController::class, 'show'])->name('layanan.show');
        
        Route::prefix('admin')->middleware(['admin'])->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard.bidan');
        
            Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users.index');
            // Route::put('/users/{user:username}/ban', [AdminUsersController::class, 'ban'])->name('admin.users.ban');
            // Route::delete('/users/{user:username}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');
        
            // Route::get('/users/details/{user:username}', [AdminUsersController::class, 'show'])->name('admin.users.detail');
            // Route::get('/users/{user:username}/hidden-posts/{post:id}', [AdminUsersController::class, 'hiddenPosts'])->name('admin.users.hidden-posts');
            // Route::get('/users/{user:username}/hidden-comments/{comment:id}', [AdminUsersController::class, 'hiddenComments'])->name('admin.users.hidden-comments');
            
            // Route::get('/posts', [AdminPostsController::class, 'index'])->name('admin.posts.index');
            // Route::get('/posts/{post:slug}', [AdminPostsController::class, 'show'])->name('admin.posts.show');
            // Route::put('/posts/{post:slug}', [AdminPostsController::class, 'hide'])->name('admin.posts.hide');
        
            // Route::get('/comments', [AdminCommentsController::class, 'index'])->name('admin.comments.index');
            // Route::get('/comments/{comment:id}', [AdminCommentsController::class, 'show'])->name('admin.comments.show');
            // Route::put('/comments/{comment:id}', [AdminCommentsController::class, 'hide'])->name('admin.comments.hide');
        
            // Route::resource('/categories', AdminCategoriesController::class)->except('show');
            
            // Route::resource('/reports', AdminReportsController::class)->except('show');
        
            // Route::get('/post-reports', [AdminPostReportsController::class, 'index'])->name('admin.post-reports.index');
            // Route::get('/post-reports/{post:slug}', [AdminPostReportsController::class, 'show'])->name('admin.post-reports.show');
            // Route::put('/post-reports/{post:slug}/hide', [AdminPostReportsController::class, 'hide'])->name('admin.post-reports.hide');
            // Route::delete('/post-reports/{post:id}', [AdminPostReportsController::class, 'deleteReports'])->name('admin.post-reports.delete');
        
            // Route::get('/comment-reports', [AdminCommentReportsController::class, 'index'])->name('admin.comment-reports.index');
            // Route::get('/comment-reports/{comment:id}', [AdminCommentReportsController::class, 'show'])->name('admin.comment-reports.show');
            // Route::put('/comment-reports/{comment:id}', [AdminCommentReportsController::class, 'hide'])->name('admin.comment-reports.hide');
            // Route::delete('/comment-reports/{comment:id}', [AdminCommentReportsController::class, 'deleteReports'])->name('admin.comment-reports.delete');
            
            // layanan untuk admin
            Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
            Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
            Route::patch('/layanan/{id}/nonaktifkan', [LayananController::class, 'nonaktifkan'])->name('layanan.nonaktifkan');
            Route::patch('/layanan/{id}/aktifkan', [LayananController::class, 'aktifkan'])->name('layanan.aktifkan');
            Route::post('layanan', [LayananController::class, 'store'])->name('layanan.store');
            Route::get('layanan/create', [LayananController::class, 'create'])->name('layanan.create');
        
            // Route untuk menampilkan form tambah pengguna
            Route::get('/dashboard/users/create', [AdminUsersController::class, 'create'])->name('users.create');
        
            // Route untuk menyimpan data pengguna
            Route::post('/dashboard/users', [AdminUsersController::class, 'store'])->name('users.store');
            Route::put('/users/{id}/update-status', [AdminUsersController::class, 'updateStatus'])->name('users.update.status');
            Route::put('/users/{id}', [AdminUsersController::class, 'update'])->name('admin.users.update');
        
            // Rute untuk halaman daftar janji temu
            Route::get('/janjitemu', [AdminJanjiTemuController::class, 'index'])
                ->name('janjitemu.index');


            Route::post('/janji-temu', [AdminJanjiTemuController::class, 'store'])->name('janjitemu.store');
            Route::put('/janji-temu/{id}', [AdminJanjiTemuController::class, 'update'])->name('janjitemu.update');        
       
            // Daftar transaksi
            Route::get('/transaksi', [AdminTransaksiController::class, 'index'])->name('transaksi.index');
    
    
            Route::get('/ulasan', [AdminUlasanController::class, 'index'])->name('admin.ulasan.index');
            Route::put('/ulasan/{ulasan}/blok', [AdminUlasanController::class, 'block'])->name('ulasan.blok');
            Route::put('/ulasan/{ulasan}/aktifkan', [AdminUlasanController::class, 'activate'])->name('ulasan.aktifkan');        
        });
    });
});

require __DIR__.'/auth.php'; // pastikan auth routes juga terinclude


