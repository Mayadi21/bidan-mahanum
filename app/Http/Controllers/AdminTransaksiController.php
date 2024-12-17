<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\QueryException;
use App\Models\DetailTransaksi;
use App\Models\JanjiTemu;
use App\Models\Layanan;

class AdminTransaksiController extends Controller
{
  public function index()
  {
      // Ambil data dari view_transaksi_summary
      $transaksi = DB::table('view_transaksi')->get();
      $janji_temu = DB::table('view_jadwal_janji_temu')
        ->where('status', 'disetujui')
        ->orderBy('waktu_mulai', 'desc')
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

    public function create()
    {
        $janji_temu = DB::table('view_jadwal_janji_temu')
        ->where('status', 'disetujui')
        ->whereBetween('waktu_mulai', [
            now()->subDays(2)->startOfDay()->toDateTimeString(),
            now()->endOfDay()->toDateTimeString()
        ])
        ->orderBy('waktu_mulai', 'desc')
        ->get();
      $layanan = Layanan::aktif()->get();
      $pasien = User::aktif()->where('role', 'user')->get();
      $bidan = User::aktif()->where('role', 'admin')->orWhere('role', 'pegawai')->get();

        return view('dashboard.transaksi.create', [
            'page' => 'Tambah Transaksi',
            'active' => 'admin-transaksi',
            'pasien' => $pasien,
            'janji_temu' => $janji_temu,
            'layanan' => $layanan,
            'pasien' => $pasien,
            'bidan' => $bidan,
        ]);

    }


  public function kunjungan()
  {
      // Ambil data dari view_transaksi_summary
      $transaksi = DB::table('view_transaksi')->get();
      $janji_temu = DB::table('view_jadwal_janji_temu')
        ->where('status', 'disetujui')
        ->whereBetween('waktu_mulai', [
        now()->subDays(2)->startOfDay()->toDateTimeString(),
        now()->addDays(2)->endOfDay()->toDateTimeString()
    ])

        ->orderBy('waktu_mulai', 'desc')
        ->get();
      $layanan = Layanan::aktif()->get();
      $pasien = User::aktif()->where('role', 'user')->get();
      $bidan = User::aktif()->where('role', 'admin')->orWhere('role', 'pegawai')->get();
  
      return view('dashboard.admin-kunjungan.index', [
          'page' => 'Halaman Transaksi',
          'active' => 'admin-kunjungan',
          'transaksi' => $transaksi,
          'janji_temu' => $janji_temu,
          'layanan' => $layanan,
          'pasien' => $pasien,
          'bidan' => $bidan,

      ]);
  }

  public function show($id)
{
    $transaksi = DB::table('view_transaksi')->where('transaksi_id', $id)->first();

    // Kirim data ke view
    return view('dashboard.transaksi.show', [
        'page' => 'Halaman Transaksi',
        'active' => 'admin-kunjungan',
        'transaksi' => $transaksi
    ]);
}


  public function store(Request $request)
  {
      // Validasi input
      $request->validate([
          'janji_temu' => 'required|string',
          'janji_id' => 'nullable|exists:view_jadwal_janji_temu,id', // Validasi menggunakan view
          'pasien_id' => 'nullable|exists:users,id',
          'layanan' => 'required|array|min:1',
          'layanan.*' => 'exists:layanan,id',
          'keterangan' => 'nullable|string',
      ]);
  
      // Tentukan pasien berdasarkan janji temu atau input langsung
      if ($request->janji_temu === 'ya') {
          $janjiTemu = DB::table('view_jadwal_janji_temu')->find($request->janji_id); // Menggunakan view
          if (!$janjiTemu) {
              return back()->withErrors(['janji_id' => 'Janji temu tidak ditemukan.'])->withInput();
          }
  
          // Validasi waktu mulai janji temu
          if (now()->toDateString() !== Carbon::parse($janjiTemu->waktu_mulai)->toDateString()) {
              return back()->withErrors(['janji_id' => 'Janji temu hanya dapat diproses pada tanggal waktu mulai.'])->withInput();
          }
  
          $pasienId = $janjiTemu->id_pasien;
          $janjiId = $request->janji_id; // Menyimpan ID janji temu
      } else {
          $pasienId = $request->pasien_id;
          $janjiId = null; // Tidak ada janji temu jika pilih "tidak"
      }
  
      // Buat transaksi baru
      DB::beginTransaction();
      try {
          $transactionId = DB::table('transaksi')->insertGetId([
              'id_pasien' => $pasienId,
              'janji_id' => $janjiId,
              'bidan' => Auth::user()->id,
              'keterangan' => $request->keterangan,
              'tanggal' => now(),
          ]);
  
          // Tambahkan layanan yang dipilih
// Tambahkan layanan yang dipilih
foreach ($request->layanan as $layananId) {
    $layanan = DB::table('layanan')->find($layananId);
    $potongan = 0; // Default potongan adalah 0
    
    if ($layanan) {
        // Cek apakah layanan memiliki promo
        if ($janjiId && $janjiTemu->jadwal_promo_id) {
            $promo = DB::table('promo')
                ->join('detail_promo', 'promo.id', '=', 'detail_promo.promo_id')
                ->where('detail_promo.id', $janjiTemu->jadwal_promo_id)
                ->where('promo.layanan_id', $layananId)
                ->first();

            if ($promo) {
                $potongan = $promo->diskon; 
            }
        }

        DB::table('detail_transaksi')->insert([
            'transaksi_id' => $transactionId,
            'layanan_id' => $layananId,
            'harga' => $layanan->harga, // Harga layanan
            'potongan' => $potongan, // Diskon yang diterapkan
        ]);
    
}

          }
  
          // Tandai janji temu sebagai selesai jika berasal dari janji temu
          if ($request->janji_temu === 'ya') {
              DB::table('janji_temu')
                  ->where('id', $request->janji_id)
                  ->update(['status' => 'selesai', 'keterangan' => $request->keterangan]);
          }
  
          DB::commit();
  
          return redirect()->back()->with('success', 'Transaksi berhasil disimpan.');
      } catch (\Exception $e) {
          DB::rollBack();
          return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan transaksi.'])->withInput();
      }
  }
  


}