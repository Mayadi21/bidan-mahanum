<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Penggajian;
use App\Models\GajiPokok;
use Illuminate\Database\QueryException;

class AdminPenggajianController extends Controller
{

  public function index()
  {
    $penggajian = DB::table('view_penggajian')->get();

    return view('dashboard.penggajian.index', [
      'page' => 'Halaman Penggajian',
      'active' => 'admin-penggajian',
      'penggajian' => $penggajian,
    ]);
  }

  public function indexGajiPokok()
  {
    $gajiPokok = DB::table('view_gaji_pokok')->get();


    return view('dashboard.penggajian.gajipokok', [
      'page' => 'Halaman GajiPokok',
      'active' => 'admin-penggajian',
      'gajiPokok' => $gajiPokok,
    ]);
  }

  public function updateGajiPokok(Request $request, $id)
  {
    DB::statement("SET @modifier_id = ?", [auth()->id()]);

    $request->validate([
      'gaji_pokok' => 'required|integer|min:0',
    ]);

    $gajiPokok = GajiPokok::findOrFail($id);
    $gajiPokok->gaji_pokok = $request->gaji_pokok;
    $gajiPokok->save();

    return redirect()->route('gaji-pokok.index')->with('success', 'Gaji pokok berhasil diperbarui.');
  }


  public function updateStatus($id)
  {
    DB::statement("SET @modifier_id = ?", [auth()->id()]);

    // Find the record by ID
    $penggajian = Penggajian::findOrFail($id);

    // Update the status to 'Sudah Diserahkan'
    $penggajian->status = '1';  // '1' for 'Sudah Diserahkan'
    $penggajian->tanggal_penggajian = now();
    $penggajian->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Status penggajian berhasil diperbarui.');
  }

  
  public function gajiSaya()
{
    // Mengambil data gaji pegawai dari view_penggajian berdasarkan ID yang sedang login
    $gaji = DB::table('view_penggajian')
        ->where('id_bidan', Auth::id()) // Filter berdasarkan id_bidan dari user yang login
        ->orderBy('tanggal_penggajian', 'desc')
        ->get();

    return view('dashboard.pegawai-gaji.index', [
        'page' => 'Halaman Gaji Saya',
        'active' => 'penggajian',
        'gaji' => $gaji,
    ]);
}

public function detailPenggajian($id)
{
    // Ambil data penggajian berdasarkan ID penggajian
    $penggajian = DB::table('penggajian')->where('id', $id)->first();

    // Cek jika data penggajian tidak ditemukan
    if (!$penggajian) {
        return redirect()->back()->with('error', 'Data penggajian tidak ditemukan.');
    }

    // Ambil detail transaksi yang sesuai dengan periode gaji
    $transaksi = DB::table('detail_transaksi')
        ->join('transaksi', 'detail_transaksi.transaksi_id', '=', 'transaksi.id')
        ->join('layanan', 'detail_transaksi.layanan_id', '=', 'layanan.id')
        ->whereBetween('transaksi.tanggal', [$penggajian->awal_periode_gaji, $penggajian->akhir_periode_gaji])
        ->select(
            'transaksi.id as transaksi_id',
            'transaksi.tanggal as tanggal_transaksi',
            'layanan.jenis_layanan',
            'detail_transaksi.bonus_pegawai'
        )
        ->get();

    return view('dashboard.penggajian.detail', [
        'transaksi' => $transaksi,
        'penggajian' => $penggajian,
        'page' => 'Detail Penggajian',
        'active' => 'admini-penggajian'
    ]);
}


}
