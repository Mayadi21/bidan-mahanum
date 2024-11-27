<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Layanan;
use Illuminate\Database\QueryException;

class AdminTransaksiController extends Controller
{
  public function index()
  {
      // Ambil data dari view_transaksi_summary
      $transaksi = DB::table('view_transaksi')->get();
      $janji_temu = DB::table('view_jadwal_janji_temu')
        ->where('status', 'disetujui')
        ->whereBetween('waktu_janji', [
            now()->subDays(2)->startOfDay()->toDateTimeString(),
            now()->endOfDay()->toDateTimeString()
        ])
        ->orderBy('waktu_janji', 'desc')
        ->get();
      $layanan = Layanan::aktif()->get();
      $pasien = User::aktif()->where('role', 'user')->get();
      $bidan = User::aktif()->where('role', 'admin')->orWhere('role', 'pegawai')->get();
  
      return view('dashboard.transaksi.index', [
          'page' => 'Halaman Transaksi',
          'active' => 'admin-transaksi',
          'transaksi' => $transaksi,
          'janji_temu' => $janji_temu,
          'layanan' => $layanan,
          'pasien' => $pasien,
          'bidan' => $bidan,

      ]);
  }
  

}