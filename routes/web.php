<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\AdminJanjiTemuController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminPenggajianController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\UserJanjiTemuController;
use App\Http\Controllers\janjitemuController;
use App\Http\Controllers\RujukanController;




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


        Route::post('/layanan/{layanan}/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
        Route::put('/ulasan/{id}', [UlasanController::class, 'update'])->name('ulasan.update');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');
        Route::get('/promo/{id}', [PromoController::class, 'show'])->name('promo.show');
        Route::get('/promo/{id}/register-patient', [PromoController::class, 'halamanDaftarPromo'])->name('promo.registerPatientForm');
        Route::post('/promo/{id}/register-patient', [PromoController::class, 'registerPatient'])->name('promo.registerPatient');


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
            Route::get('/janji-temu/sediakan-jadwal', [AdminJanjiTemuController::class, 'createJadwal'])->name('jadwal.sediakan');
            Route::post('/janji-temu/jadwal', [AdminJanjiTemuController::class, 'storeJadwal'])->name('jadwal.store');
            Route::get('/janji-temu/jadwal', [AdminJanjiTemuController::class, 'getJanjiTemuByDate'])->name('jadwal.janjitemu');
            Route::get('/janji-temu/create', [AdminJanjiTemuController::class, 'create'])->name('janjitemu.create');

            Route::get('/promo/create', [PromoController::class, 'create'])->name('promo.create');
            Route::post('/promo', [PromoController::class, 'store'])->name('promo.store');

            // Daftar transaksi
            Route::get('/transaksi', [AdminTransaksiController::class, 'index'])->name('transaksi.index');
            Route::post('/transaksi/store', [AdminTransaksiController::class, 'storeTransaction'])->name('transaksi.store');
            Route::get('/transaksi/create', [AdminTransaksiController::class, 'create'])->name('transaksi.create');

            Route::get('/kunjungan', [AdminTransaksiController::class, 'kunjungan'])->name('kunjungan.index');

            //route untuk ulasan
            Route::get('/ulasan', [UlasanController::class, 'index'])->name('admin.ulasan.index');
            Route::put('/ulasan/{ulasan}/blok', [UlasanController::class, 'block'])->name('ulasan.blok');
            Route::put('/ulasan/{ulasan}/aktifkan', [UlasanController::class, 'activate'])->name('ulasan.aktifkan');

            Route::get('/rujukan', [RujukanController::class, 'index'])->name('admin.rujukan.index');
            Route::get('/rujukan/create', [RujukanController::class, 'create'])->name('rujukan.create');
            Route::post('/rujukan', [RujukanController::class, 'store'])->name('rujukan.store');
            Route::get('/rujukan/{id}/edit', [RujukanController::class, 'edit'])->name('rujukan.edit');
            Route::put('/rujukan/{id}', [RujukanController::class, 'update'])->name('rujukan.update');
            Route::delete('/rujukan/{id}', [RujukanController::class, 'destroy'])->name('rujukan.destroy');
            Route::get('/rujukan/{id}/cetak', [RujukanController::class, 'cetak'])->name('rujukan.cetak');

            Route::get('/gaji-pegawai', [AdminPenggajianController::class, 'show'])->name('gaji.pegawai');

        });



        Route::prefix('user')->middleware(['user'])->group(function () {
            Route::get('/riwayat-kunjungan/{idPasien}', [DashboardController::class, 'riwayatKunjungan'])->name('riwayat.kunjungan');
            Route::get('/janji-temu', [UserJanjiTemuController::class, 'index'])->name('user.janjitemu.index');
            Route::post('/janji-temu', [UserJanjiTemuController::class, 'store'])->name('user.janjitemu.store');
            Route::put('/janji-temu/{id}', [UserJanjiTemuController::class, 'update'])->name('user.janjitemu.update');
            //
            Route::get('/janji-temu/{idPasien}', [DashboardController::class, 'janjiTemu'])->name('janji.temu');
            Route::post('/janji-temu', [janjitemuController::class, 'store'])->name('janji.temu.store');
        });
    });
});

require __DIR__ . '/auth.php';
