<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  // Pastikan DB di-import
use App\Models\JanjiTemu;
use App\Models\Ulasan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil data transaksi dari view_transaksi
        $transaksi = DB::table('view_transaksi')->get();

        $transaksiHariIni = DB::select("SELECT get_transaksi_by_date(?) AS jumlah_transaksi", [now()->toDateString()]);
        $transaksiHariIni = $transaksiHariIni[0]->jumlah_transaksi;


        // Hitung jumlah janji temu yang menunggu konfirmasi
        $janjiTemuPending = JanjiTemu::where('status', 'menunggu konfirmasi')->count();

        // Hitung jumlah total ulasan
        $totalUlasan = Ulasan::count();


        // Ambil data janji temu hari ini dari view_janji_temu
        $janjiTemuHariIni = DB::table('view_jadwal_janji_temu')->whereDate('status', 'disetujui')->where('waktu_mulai', today())->get(); // Mengambil semua data janji temu hari ini

        return view('dashboard.bidan-index', [
            'page' => 'Admin Dashboard',
            'active' => 'admin-dashboard',
            'users' => User::aktif(),
            'transaksi' => $transaksi,
            'transaksiHariIni' => $transaksiHariIni,
            'janjiTemuPending' => $janjiTemuPending, // Perbaiki nama variabel menjadi konsisten
            'totalUlasan' => $totalUlasan, // Perbaiki nama variabel menjadi konsisten
            'janjiTemuHariIni' => $janjiTemuHariIni
        ]);
    }
}
