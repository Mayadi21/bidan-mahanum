<?php

use Illuminate\Support\Facades\Route;

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




Route::prefix('dashboard')->middleware(['auth', 'notBanned', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/posts', DashboardPostsController::class);

    // Done
    Route::get('/comments', [DashboardCommentsController::class, 'index'])->name('dashboard.comments.index');
    Route::get('/comments/{comment:id}', [DashboardCommentsController::class, 'show'])->name('dashboard.comments.show');
    Route::delete('/comments/{comment:id}', [DashboardCommentsController::class, 'destroy'])->name('dashboard.comments.destroy');


    Route::prefix('admin')->middleware(['admin'])->group(function () {

        // Done
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
    
        // Done
        Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users.index');
        Route::put('/users/{user:username}', [AdminUsersController::class, 'role'])->name('admin.users.role');
        Route::put('/users/{user:username}/ban', [AdminUsersController::class, 'ban'])->name('admin.users.ban');
        Route::delete('/users/{user:username}', [AdminUsersController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('/users/details/{user:username}', [AdminUsersController::class, 'show'])->name('admin.users.detail');
        Route::get('/users/{user:username}/hidden-posts/{post:id}', [AdminUsersController::class, 'hiddenPosts'])->name('admin.users.hidden-posts');
        Route::get('/users/{user:username}/hidden-comments/{comment:id}', [AdminUsersController::class, 'hiddenComments'])->name('admin.users.hidden-comments');
        
        // Done
        Route::get('/posts', [AdminPostsController::class, 'index'])->name('admin.posts.index');
        Route::get('/posts/{post:slug}', [AdminPostsController::class, 'show'])->name('admin.posts.show');
        Route::put('/posts/{post:slug}', [AdminPostsController::class, 'hide'])->name('admin.posts.hide');
    
        // Done
        Route::get('/comments', [AdminCommentsController::class, 'index'])->name('admin.comments.index');
        Route::get('/comments/{comment:id}', [AdminCommentsController::class, 'show'])->name('admin.comments.show');
        Route::delete('/comments/{comment:id}', [AdminCommentsController::class, 'destroy'])->name('admin.comments.destroy');
    
        // Done
        Route::resource('/categories', AdminCategoriesController::class)->except('show');
        
        // Done
        Route::resource('/reports', AdminReportsController::class)->except('show');

        // Done
        Route::get('/post-reports', [AdminPostReportsController::class, 'index'])->name('admin.post-reports.index');
        Route::get('/post-reports/{post:slug}', [AdminPostReportsController::class, 'show'])->name('admin.post-reports.show');
        Route::put('/post-reports/{post:slug}', [AdminPostReportsController::class, 'hide'])->name('admin.post-reports.hide');

        // Done
        Route::get('/comment-reports', [AdminCommentReportsController::class, 'index'])->name('admin.comment-reports.index');
        Route::get('/comment-reports/{comment:id}', [AdminCommentReportsController::class, 'show'])->name('admin.comment-reports.show');
        Route::put('/comment-reports/{comment:id}', [AdminCommentReportsController::class, 'hide'])->name('admin.comment-reports.hide');

    });

});