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
use App\Http\Controllers\Dashboard\AdminPenggajianController;
use App\Http\Controllers\Dashboard\AdminUlasanController;




Route::get('/banned', [HomeController::class, 'banned'])->name('banned');

Route::middleware('notBanned')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
});

Route::middleware(['auth', 'notBanned'])->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/posts', DashboardPostsController::class);
                
        Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
        Route::get('/layanan/{id}', [LayananController::class, 'show'])->name('layanan.show');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');


        
        Route::prefix('admin')->middleware(['admin'])->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard.bidan');
        
            Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users.index');            
   
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
    
            //route untuk ulasan
            Route::get('/ulasan', [AdminUlasanController::class, 'index'])->name('admin.ulasan.index');
            Route::put('/ulasan/{ulasan}/blok', [AdminUlasanController::class, 'block'])->name('ulasan.blok');
            Route::put('/ulasan/{ulasan}/aktifkan', [AdminUlasanController::class, 'activate'])->name('ulasan.aktifkan');        

            //route untuk sistem penggajian
            Route::get('/pengajian', [AdminPenggajianController::class, 'index'])->name('admin.penggajian.index');
            //route untuk halaman gaji pokok
            Route::get('/gaji-pokok', [AdminPenggajianController::class, 'indexGajiPokok'])->name('gaji-pokok.index');
            Route::put('/gaji-pokok/{id}', [AdminPenggajianController::class, 'updateGajiPokok'])->name('gaji-pokok.update');

        });

        Route::prefix('user')->middleware(['user'])->group(function () {
            //route untuk user melihat riwayat kunjungan 
            Route::get('/riwayat-kunjungan/{idPasien}', [DashboardController::class, 'riwayatKunjungan'])->name('riwayat.kunjungan');
        });
    });
});

require __DIR__.'/auth.php'; // pastikan auth routes juga terinclude


