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

  public function indexGajiPokok(){
    $gajiPokok = DB::table('view_gaji_pokok')->get();
  
  
    return view('dashboard.penggajian.gajipokok', [
      'page' => 'Halaman GajiPokok',
      'active' => 'admin-penggajian',
      'gajiPokok' => $gajiPokok,
    ]);
  }

  public function updateGajiPokok(Request $request, $id)
  {
      $request->validate([
          'gaji_pokok' => 'required|integer|min:0',
      ]);
  
      $gajiPokok = GajiPokok::findOrFail($id);
      $gajiPokok->gaji_pokok = $request->gaji_pokok;
      $gajiPokok->save();
  
      return redirect()->route('gaji-pokok.index')->with('success', 'Gaji pokok berhasil diperbarui.');
  }
  

}