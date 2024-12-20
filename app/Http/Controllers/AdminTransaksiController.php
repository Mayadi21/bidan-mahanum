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
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        // Ambil data dari view_transaksi_summary
        $transaksi = DB::table('view_transaksi')->
        orderBy('tanggal', 'desc')->get();
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


    public function kunjungan(Request $request)
    {

    
        $search = $request->input('search');

        $transaksi = DB::table('view_transaksi')
            ->when($search, function($query, $search) {
                $query->where('nama_pasien', 'like', '%' . $search . '%')
                      ->orWhere('tanggal', 'like', '%' . $search . '%')
                      ->orWhere('nama_bidan', 'like', '%' . $search . '%');
            })->orderBy('tanggal', 'desc')
            ->get();
    
        $janji_temu = DB::table('view_jadwal_janji_temu')
            ->where('status', 'disetujui')
            ->whereBetween('waktu_mulai', [
                now()->startOfDay()->toDateTimeString(),
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
        // Ambil data transaksi dari view_transaksi berdasarkan transaksi_id
        $transaksi = DB::table('view_transaksi')->where('transaksi_id', $id)->first();
    
        // Periksa jika transaksi tidak ditemukan
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->withErrors(['error' => 'Transaksi tidak ditemukan.']);
        }
    
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
        'janji_id' => 'nullable|exists:view_jadwal_janji_temu,id',
        'pasien_id' => 'nullable|exists:users,id',
        'layanan' => 'required|array|min:1',
        'layanan.*' => 'exists:layanan,id',
        'keterangan' => 'nullable|string',
    ]);

    // Tentukan pasien berdasarkan janji temu atau input langsung
    $janjiTemu = $request->janji_temu === 'ya' ? 'ya' : 'tidak';
    $janjiId = $request->janji_temu === 'ya' ? $request->janji_id : null;
    $pasienId = $request->janji_temu === 'ya' ? null : $request->pasien_id;
    $bidanId = Auth::user()->id;
    $keterangan = $request->keterangan;
    $tanggal = now()->toDateTimeString();

    // Ubah array layanan menjadi string ID dipisahkan dengan koma
    $layananIds = implode(',', $request->layanan);

    try {
        // Panggil Stored Procedure
        DB::statement("SET @modifier_id = ?", [auth()->id()]);
        DB::statement('CALL simpan_transaksi(?, ?, ?, ?, ?, ?, ?)', [
            $janjiTemu,         // IN p_janji_temu
            $janjiId,           // IN p_janji_id
            $pasienId,          // IN p_pasien_id
            $bidanId,           // IN p_bidan_id
            $keterangan,        // IN p_keterangan
            $tanggal,           // IN p_tanggal
            $layananIds         // IN p_layanan_ids
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    } catch (\Exception $e) {
        return redirect()->route('transaksi.index')->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
    }
}


    public function surat($id)
    {
        // Ambil data transaksi berdasarkan ID dari view_transaksi
        $transaksi = DB::table('view_transaksi')->where('transaksi_id', $id)->first();

        // Jika data transaksi ditemukan, kirim ke view
        if (!$transaksi) {
            abort(404, 'Transaksi tidak ditemukan');
        }
        
        // Load view 'surat' dengan data transaksi dan generate PDF
        $pdf = Pdf::loadView('dashboard.transaksi.surat', compact('transaksi'))
            ->setPaper('a4', 'portrait');
        
        // Stream atau download PDF dengan nama file yang dinamis
        return $pdf->stream('Surat_Transaksi_' . $transaksi->transaksi_id . '.pdf');
    }

}