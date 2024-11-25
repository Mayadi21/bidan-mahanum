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
  
      return view('dashboard.transaksi.index', [
          'page' => 'Halaman Transaksi',
          'active' => 'admin-transaksi',
          'transaksi' => $transaksi,
      ]);
  }
  

}