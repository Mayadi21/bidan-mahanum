<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PostsController as DashboardPostsController;
use App\Http\Controllers\Dashboard\CommentsController as DashboardCommentsController;
use App\Http\Controllers\Dashboard\AdminUsersController;
use App\Http\Controllers\Dashboard\AdminPostsController;
use App\Http\Controllers\Dashboard\AdminReportsController;
use App\Http\Controllers\Dashboard\AdminCommentsController;
use App\Http\Controllers\Dashboard\AdminDashboardController; 
use App\Http\Controllers\Dashboard\AdminCategoriesController;



Route::prefix('dashboard')->middleware(['verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/posts', DashboardPostsController::class);

    Route::get('/comments', [DashboardCommentsController::class, 'index'])->name('dashboard.comments.index');
    Route::get('/comments/{comment:id}', [DashboardCommentsController::class, 'show'])->name('dashboard.comments.show');


    Route::prefix('admin')->middleware(['admin'])->group(function () {

        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
    
        Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users.index');
        
        Route::get('/posts', [AdminPostsController::class, 'index'])->name('admin.posts.index');
    
        Route::get('/comments', [AdminCommentsController::class, 'index'])->name('admin.comments.index');
    
        Route::resource('/categories', AdminCategoriesController::class)->except('show');
        
        Route::get('/reports', [AdminReportsController::class, 'index'])->name('admin.reports.index');

        Route::get('/post-reports', [AdminReportsController::class, 'index'])->name('admin.post-reports.index');

        Route::get('/comment-reports', [AdminReportsController::class, 'index'])->name('admin.comment-reports.index');

    });

});