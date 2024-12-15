<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            now()->endOfDay()->toDateTimeString()
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

// public function storeTransaction(Request $request)
// {
//     // Validasi input data
//     $request->validate([
//         'janji_temu' => 'required|string|in:ya,tidak',
//         'id_pasien' => 'required|exists:users,id',
//         'bidan_id' => 'required|exists:users,id',
//         'layanan' => 'required|array',
//         'layanan.*' => 'required|exists:layanan,id',
//         'keterangan' => 'nullable|string',
//         'janji_id' => 'nullable|exists:janji_temu,id', // validasi jika ada janji temu yang dipilih
//     ]);

//     // Mulai transaksi untuk memastikan konsistensi data
//     DB::beginTransaction();

//     try {
//         // Menyimpan data transaksi
//         $transaksi = Transaksi::create([
//             'id_pasien' => $request->id_pasien,
//             'janji_id' => $request->janji_temu === 'ya' ? $request->janji_id : null,
//             'bidan' => $request->bidan_id,
//             'keterangan' => $request->keterangan,
//         ]);

//         // Menyimpan detail transaksi (layanan yang dipilih)
//         foreach ($request->layanan as $layanan_id) {
//             $layanan = Layanan::findOrFail($layanan_id); // Mengambil data layanan
//             DetailTransaksi::create([
//                 'transaksi_id' => $transaksi->id,
//                 'layanan_id' => $layanan->id,
//                 'harga' => $layanan->harga,
//             ]);
//         }

//         // Jika transaksi berhubungan dengan janji temu, ubah status janji temu
//         if ($request->janji_temu === 'ya' && $request->janji_id) {
//             $janjiTemu = JanjiTemu::findOrFail($request->janji_id);
//             $janjiTemu->status = 'disetujui';
//             $janjiTemu->save();
//         }

//         // Commit transaksi
//         \DB::commit();

//         return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
//     } catch (\Exception $e) {
//         // Rollback transaksi jika ada error
//         \DB::rollBack();

//         // Tampilkan pesan error
//         return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
//     }
  

// }

public function storeTransaction(Request $request)
{
    // Validasi input
    $request->validate([
        'janji_temu' => 'required|string',
        'janji_id' => 'nullable|exists:janji_temu,id',
        'pasien_id' => 'nullable|exists:users,id',
        'bidan_id' => 'required|exists:users,id',
        'layanan' => 'required|array|min:1',
        'layanan.*' => 'exists:layanan,id',
        'keterangan' => 'nullable|string',
    ]);

    // Tentukan pasien berdasarkan janji temu atau input langsung
    if ($request->janji_temu === 'ya') {
        $janjiTemu = DB::table('janji_temu')->find($request->janji_id);
        if (!$janjiTemu) {
            return back()->withErrors(['janji_id' => 'Janji temu tidak ditemukan.'])->withInput();
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
            'bidan' => $request->bidan_id,
            'keterangan' => $request->keterangan,
            'tanggal' => now(),
        ]);

        // Tambahkan layanan yang dipilih
        foreach ($request->layanan as $layananId) {
            $layanan = DB::table('layanan')->find($layananId);
            if ($layanan) {
                DB::table('detail_transaksi')->insert([
                    'transaksi_id' => $transactionId,
                    'layanan_id' => $layananId,
                    'harga' => $layanan->harga, // Menambahkan harga layanan
                ]);
            }
        }

        // Tandai janji temu sebagai selesai jika berasal dari janji temu
        if ($request->janji_temu === 'ya') {
            DB::table('janji_temu')
                ->where('id', $request->janji_id)
                ->update(['status' => 'selesai', 'keterangan' => $request->keterangan])
                ;
        }

        DB::commit();

        return redirect()->back()->with('success', 'Transaksi berhasil disimpan.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan transaksi.'])->withInput();
    }
}

// public function store(Request $request)
//     {
//         $validatedData = $request->validate([
//             'pasien_id' => 'required_if:janji_temu,tidak|exists:users,id',
//             'janji_temu' => 'required|in:ya,tidak',
//             'janji_id' => 'nullable|exists:janji_temu,id',
//             'bidan_id' => 'required|exists:users,id',
//             'layanan' => 'required|array|min:1',
//             'layanan.*' => 'exists:layanan,id',
//             'keterangan' => 'nullable|string',
//         ]);

//         // Simpan data transaksi
//         $transaksi = new Transaksi();
//         $transaksi->id_pasien = $request->janji_temu === 'ya' ? JanjiTemu::find($request->janji_id)->id_pasien : $request->pasien_id;
//         $transaksi->janji_id = $request->janji_temu === 'ya' ? $request->janji_id : null;
//         $transaksi->bidan = $request->bidan_id;
//         $transaksi->keterangan = $request->keterangan;
//         $transaksi->save();

//         // Simpan detail transaksi untuk setiap layanan
//         foreach ($request->layanan as $layanan_id) {
//             $layanan = \App\Models\Layanan::find($layanan_id);
//             $detailTransaksi = new DetailTransaksi();
//             $detailTransaksi->transaksi_id = $transaksi->id;
//             $detailTransaksi->layanan_id = $layanan_id;
//             $detailTransaksi->harga = $layanan->harga;
//             $detailTransaksi->save();
//         }

//         // Update status janji temu jika ada
//         if ($transaksi->janji_id) {
//             $janjiTemu = JanjiTemu::find($transaksi->janji_id);
//             $janjiTemu->status = 'selesai';
//             $janjiTemu->keterangan = $request->keterangan;
//             $janjiTemu->save();
//         }

//         return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan.');
//     }


}