<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;  // Pastikan DB di-import

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil data transaksi dari view_transaksi
        $transaksi = DB::table('view_transaksi')->get();

        // Mengambil jumlah transaksi hari ini
        $transaksiHariIni = DB::table('transaksi')
        ->whereDate('tanggal', '=', now()->toDateString())  // Mengambil transaksi yang terjadi hari ini
        ->count();

        // Ambil data janji temu hari ini dari view_janji_temu
        $janjiTemuHariIni = DB::table('view_jadwal_janji_temu')->where('status', 'disetujui')->where('waktu_janji', today())->get(); // Mengambil semua data janji temu hari ini

        return view('dashboard.bidan-index', [
            'page' => 'Admin Dashboard',
            'active' => 'admin-dashboard',
            'users' => User::aktif(),
            'transaksi' => $transaksi,
            'transaksiHariIni' => $transaksiHariIni,  // Menambahkan jumlah transaksi hari ini ke view
            'janjiTemuHariIni' => $janjiTemuHariIni, // Menambahkan data janji temu hari ini ke view
        ]);
    }
}