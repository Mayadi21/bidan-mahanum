<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostsController as DashboardPostsController;
use App\Http\Controllers\CommentsController as DashboardCommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminPostsController; 
use App\Http\Controllers\AdminReportsController;
use App\Http\Controllers\AdminCommentsController;
use App\Http\Controllers\AdminDashboardController; 
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\AdminPostReportsController;
use App\Http\Controllers\AdminCommentReportsController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\AdminJanjiTemuController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminPenggajianController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\UserJanjiTemuController;
use App\Http\Controllers\janjitemuController;




Route::get('/banned', [HomeController::class, 'banned'])->name('banned');

Route::middleware('notBanned')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
    Route::get('/layanan/{id}', [LayananController::class, 'show'])->name('layanan.show');


});

Route::middleware(['auth', 'notBanned'])->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/posts', DashboardPostsController::class);
                

        Route::post('/layanan/{layanan}/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
        Route::put('/ulasan/{id}', [UlasanController::class, 'update'])->name('ulasan.update');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');


        
        Route::prefix('admin')->middleware(['admin'])->group(function () {
          
   
            // layanan untuk admin
            Route::put('/layanan/{id}', [LayananController::class, 'update'])->name('layanan.update');
            Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
            Route::patch('/layanan/{id}/nonaktifkan', [LayananController::class, 'nonaktifkan'])->name('layanan.nonaktifkan');
            Route::patch('/layanan/{id}/aktifkan', [LayananController::class, 'aktifkan'])->name('layanan.aktifkan');
            Route::post('layanan', [LayananController::class, 'store'])->name('layanan.store');
            Route::get('layanan/create', [LayananController::class, 'create'])->name('layanan.create');       
              

            //route untuk sistem penggajian
            Route::get('/penggajian', [AdminPenggajianController::class, 'index'])->name('admin.penggajian.index');
            Route::put('/update-status-gaji/{id}', [AdminPenggajianController::class, 'updateStatus'])->name('gaji-update-status');

            //route untuk halaman gaji pokok
            Route::get('/gaji-pokok', [AdminPenggajianController::class, 'indexGajiPokok'])->name('gaji-pokok.index');
            Route::put('/gaji-pokok/{id}', [AdminPenggajianController::class, 'updateGajiPokok'])->name('gaji-pokok.update');

        });

        

        Route::prefix('bidan')->middleware(['adminOrPegawai'])->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard.bidan');
    
            Route::get('/users', [AdminUsersController::class, 'index'])->name('admin.users.index'); 
            
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
            Route::post('/transaksi/store', [AdminTransaksiController::class, 'storeTransaction'])->name('transaksi.store');

            //route untuk ulasan
            Route::get('/ulasan', [UlasanController::class, 'index'])->name('admin.ulasan.index');
            Route::put('/ulasan/{ulasan}/blok', [UlasanController::class, 'block'])->name('ulasan.blok');
            Route::put('/ulasan/{ulasan}/aktifkan', [UlasanController::class, 'activate'])->name('ulasan.aktifkan'); 
            
        });        



        Route::prefix('user')->middleware(['user'])->group(function () {
            Route::get('/riwayat-kunjungan/{idPasien}', [DashboardController::class, 'riwayatKunjungan'])->name('riwayat.kunjungan');
            Route::get('/janji-temu', [UserJanjiTemuController::class, 'index'])->name('user.janjitemu.index');
            Route::post('/janji-temu', [UserJanjiTemuController::class, 'store'])->name('user.janjitemu.store');
            Route::put('/janji-temu/{id}', [UserJanjiTemuController::class, 'update'])->name('user.janjitemu.update');
//
Route::get('/riwayat-kunjungan/{idPasien}', [DashboardController::class, 'riwayatKunjungan'])->name('riwayat.kunjungan');
Route::get('/janji-temu/{idPasien}', [DashboardController::class, 'janjiTemu'])->name('janji.temu');
Route::post('/janji-temu', [janjitemuController::class, 'store'])->name('janji.temu.store');        });
    });
});

require __DIR__.'/auth.php'; // pastikan auth routes juga terinclude


