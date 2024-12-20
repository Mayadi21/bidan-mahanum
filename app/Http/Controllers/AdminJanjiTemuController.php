<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\JanjiTemu;
use App\Models\JadwalJanjiTemu;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\QueryException;



class AdminJanjiTemuController extends Controller
{
    /**
     * Display a listing of appointments.
     */
    public function index()
    {   
        $users = User::aktif()->role('user')->get();

        // Ambil data dari view
        $jadwalJanjiTemuQuery = DB::table('view_jadwal_janji_temu');
    
        // Filter berdasarkan status
        if (request('status')) {
            $jadwalJanjiTemuQuery = $jadwalJanjiTemuQuery->where('status', request('status'));
        }
    
        // Filter pencarian berdasarkan nama pasien atau keluhan
        if (request('search')) {
            $search = request('search');
            $jadwalJanjiTemuQuery = $jadwalJanjiTemuQuery->where(function ($query) use ($search) {
                $query->where('pasien_nama', 'like', '%' . $search . '%')
                      ->orWhere('keluhan', 'like', '%' . $search . '%');
            });
        }
    
        return view('dashboard.admin-janjitemu.index', [
            'page' => 'Halaman Janji Temu',
            'active' => 'admin-janjitemu',
            'janjiTemu' => $jadwalJanjiTemuQuery->get(),
            'users' => $users
        ]);
    }
    
    
/**
     * Menyimpan janji temu baru
     */


    public function store(Request $request)
    {

        $validated = $request->validate([
            'jadwal_id' => 'required|exists:jadwal_janji_temu,id',
            'id_pasien' => 'required|exists:users,id',
            'keluhan' => 'required|string|max:255',
        ]);

        // Cek kuota jadwal
        $jadwal = JadwalJanjiTemu::findOrFail($validated['jadwal_id']);
        if ($jadwal->jumlah_janji_temu >= $jadwal->kuota) {
            return redirect()->route('janjitemu.create')->with('error', 'Kuota penuh, tidak dapat menambahkan janji temu.');
        }
        try {
            DB::statement("SET @modifier_id = ?", [auth()->id()]);

            // Simpan janji temu
        JanjiTemu::create([
            'jadwal_id' => $validated['jadwal_id'],
            'id_pasien' => $validated['id_pasien'],
            'keluhan' => $validated['keluhan'],
            'status' => 'menunggu konfirmasi',
        ]);



        return redirect()->route('janjitemu.create')->with('success', 'Janji temu berhasil disimpan.');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            // Tangkap pesan error dari trigger
            if ($e->getCode() === '45000') {
                // Ambil pesan error utama dari detail pesan
                $errorMessage = $e->getPrevious() ? $e->getPrevious()->getMessage() : $e->getMessage();
                
                // Bersihkan angka dan ambil hanya pesan error setelah kode angka
                if (preg_match('/\d+\s+(.+)/', $errorMessage, $matches)) {
                    $errorMessage = trim($matches[1]); // Ambil hanya bagian setelah angka
                }
            } else {
                $errorMessage = 'Terjadi kesalahan saat menyimpan jadwal.';
            }
    
            // Redirect ke halaman sebelumnya dengan pesan error
            return redirect()->back()->withErrors(['error' => $errorMessage]);
        }
    }
    
    


    /**
     * Memperbarui status janji temu
     */
    public function update(Request $request, $id)
    {
        DB::statement("SET @modifier_id = ?", [auth()->id()]);

        $validated = $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'keterangan' => 'nullable|string|max:255',
        ]);
    
        // Cari janji temu yang ingin diperbarui
        $janjiTemu = JanjiTemu::findOrFail($id);
    
        // Periksa apakah status diubah menjadi 'ditolak' dan apakah janji temu ini memiliki jadwal_promo_id
        if ($validated['status'] === 'ditolak' && $janjiTemu->jadwal_promo_id) {
            // Kurangi kolom terpakai pada detail promo
            DB::table('detail_promo')
                ->where('id', $janjiTemu->jadwal_promo_id)
                ->decrement('terpakai');
        }
    
        // Perbarui status dan keterangan janji temu
        $janjiTemu->update([
            'status' => $validated['status'],
            'keterangan' => $validated['keterangan'] ?? $janjiTemu->keterangan,
        ]);
    
        return redirect()->route('janjitemu.index')->with(
            'success',
            'Status janji temu berhasil diperbarui.'
        );
    }
    


    public function create()
    {
        
        //  $jadwal = JadwalJanjiTemu::withCount('janjiTemu') // Mengambil jumlah janji temu yang sudah terdaftar
        //  ->get();
         
         $users = User::where('role', 'user')->where('status', 'aktif')->get();

        $jadwalJanjiTemu = JadwalJanjiTemu::all();

        foreach ($jadwalJanjiTemu as $jadwal) {
            $jadwal->jumlah_janji_temu = JanjiTemu::where('jadwal_id', $jadwal->id)    
            ->where('status', '!=', 'ditolak')
            ->count();
        }

        return view('dashboard.admin-janjitemu.create', [
            'page' => 'Daftarkan Janji Temu',
            'active' => 'admin-janjitemu',
            'jadwalJanjiTemu' => $jadwalJanjiTemu,
            'users' => $users,
        ]);
    }



    // Menampilkan form untuk menyediakan jadwal
    public function createJadwal()
    {
        return view('dashboard.admin-janjitemu.sediakan-jadwal', [
            'page' => 'Buat Jadwal Janji Temu',
            'active' => 'admin-janjitemu',
        ]);
    }


public function storeJadwal(Request $request)
{
    // Validasi input
    $request->validate([
        'tanggal' => 'required|date',
        'waktu_mulai' => 'required|array|min:1',
        'waktu_mulai.*' => 'required|date_format:H:i',
        'waktu_selesai' => 'required|array|min:1',
        'waktu_selesai.*' => 'required|date_format:H:i|after:waktu_mulai.*',
        'kuota' => 'required|array|min:1',
        'kuota.*' => 'required|integer|min:1',
    ]);

    try {
        DB::statement("SET @modifier_id = ?", [auth()->id()]);

        // Loop setiap waktu mulai dan waktu selesai
        foreach ($request->waktu_mulai as $index => $waktuMulai) {
            $waktuSelesai = $request->waktu_selesai[$index];
            $kuota = $request->kuota[$index];

            // Gabungkan tanggal dengan waktu
            $waktuMulaiFull = $request->tanggal . ' ' . $waktuMulai;
            $waktuSelesaiFull = $request->tanggal . ' ' . $waktuSelesai;

            // Simpan ke tabel jadwal_janji_temu
            JadwalJanjiTemu::create([
                'waktu_mulai' => $waktuMulaiFull,
                'waktu_selesai' => $waktuSelesaiFull,
                'kuota' => $kuota,
            ]);
        }

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Jadwal berhasil disimpan.');

    } catch (\Illuminate\Database\QueryException $e) {
        // Tangkap pesan error dari trigger
        if ($e->getCode() === '45000') {
            // Ambil pesan error utama dari detail pesan
            $errorMessage = $e->getPrevious() ? $e->getPrevious()->getMessage() : $e->getMessage();
            
            // Bersihkan angka dan ambil hanya pesan error setelah kode angka
            if (preg_match('/\d+\s+(.+)/', $errorMessage, $matches)) {
                $errorMessage = trim($matches[1]); // Ambil hanya bagian setelah angka
            }
        } else {
            $errorMessage = 'Terjadi kesalahan saat menyimpan jadwal.';
        }

        // Redirect ke halaman sebelumnya dengan pesan error
        return redirect()->back()->withErrors(['error' => $errorMessage]);
    }
}


    
    



public function getJadwalByTanggal(Request $request)
{
    $tanggal = $request->query('tanggal');

    // Ambil data jadwal berdasarkan tanggal
    $jadwal = JadwalJanjiTemu::whereDate('tanggal', $tanggal)->get();

    // Mengembalikan data jadwal dalam format JSON
    return response()->json($jadwal);
}
}