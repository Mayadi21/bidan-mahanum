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


    //  JANGAN DIHAPUS DULU
    //  public function store(Request $request)
    //  {
    //      // Validasi input
    //      $validated = $request->validate([
    //          'id_pasien' => 'required|exists:users,id',
    //          'keluhan' => 'nullable|string|max:255',
    //          'waktu_mulai' => 'required|date',
    //      ]);
     
    //      try {
    //          // Menyimpan data janji temu
    //          JanjiTemu::create([
    //              'id_pasien' => $validated['id_pasien'],
    //              'keluhan' => $validated['keluhan'],
    //              'waktu_mulai' => $validated['waktu_mulai'],
    //              'status' => 'disetujui',
    //          ]);
     
    //          // Redirect dengan pesan sukses jika berhasil
    //          return redirect()->route('janjitemu.index')->with('success', 'Janji temu berhasil ditambahkan.');
    //      } catch (QueryException $e) {
    //          // Tangkap error dari trigger database
    //          if ($e->getCode() === '45000') {
    //             // Proses pesan error untuk mengambil bagian relevan
    //             $errorMessage = $e->getMessage();
    //             if (preg_match('/Terjadi kesalahan: \[(.*?)\]/', $errorMessage, $matches)) {
    //                 $parsedMessage = $matches[1]; // Ambil teks di antara [ dan ]
    //             } else {
    //                 $parsedMessage = 'Terjadi kesalahan pada janji temu.';
    //             }
    
    //             return redirect()->back()->withInput()->with('error', $parsedMessage);
    //         }
     
    //          // Tangkap error lainnya
    //          return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    //      }
    //  }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_pasien' => 'required|exists:users,id',
            'janji_temu_id' => 'required|exists:janji_temu,id',
            'keluhan' => 'nullable|string|max:255', // Ubah validasi menjadi 'nullable'
        ]);
    
        try {
            // Cari janji temu berdasarkan ID
            $janjiTemu = JanjiTemu::findOrFail($request->janji_temu_id);
    
            // Set id_pasien dari input request
            $janjiTemu->id_pasien = $request->id_pasien;
    
            // Tambahkan data keluhan, jika ada
            $janjiTemu->keluhan = $request->keluhan; // Jika keluhan kosong, maka akan tetap disimpan sebagai NULL
            $janjiTemu->status = 'disetujui';
            $janjiTemu->save();
    
            return redirect()->back()->with('success', 'Janji temu berhasil didaftarkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    


    /**
     * Memperbarui status janji temu
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu konfirmasi,disetujui,selesai,ditolak',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $janjiTemu = JanjiTemu::findOrFail($id);

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
        // Ambil semua pengguna dari database (jika hanya pengguna tertentu, sesuaikan query-nya)
        $users = User::aktif()->role('user');
        $jadwalTersedia = JanjiTemu::whereNull('id_pasien')
                                   ->get();

        return view('dashboard.admin-janjitemu.create', [
            'page' => 'Daftarkan Janji Temu',
            'active' => 'admin-janjitemu',
            'users' => $users,
            'jadwalTersedia' => $jadwalTersedia,
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

    // // Menyimpan data janji temu dari form
    // public function storeJadwal(Request $request)
    // {
    //     $request->validate([
    //         'tanggal' => 'required|date',
    //         'waktu_mulai.*' => 'required|date_format:H:i',
    //         'waktu_selesai.*' => 'required|date_format:H:i|after:waktu_mulai.*',
    //     ]);

    //     $tanggal = $request->tanggal;

    //     foreach ($request->waktu_mulai as $index => $waktu_mulai) {
    //         $waktu_selesai = $request->waktu_selesai[$index];

    //         JanjiTemu::create([
    //             'waktu_mulai' => "$tanggal $waktu_mulai",
    //             'waktu_selesai' => "$tanggal $waktu_selesai",
    //             'status' => null, // Kolom status tetap kosong
    //         ]);
    //     }

    //     return redirect()->route('jadwal.sediakan')->with('success', 'Jadwal berhasil disimpan!');
    // }


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
}



// Mengambil daftar jadwal janji temu berdasarkan tanggal
public function getJadwalJanjiTemuByDate(Request $request)
{
    $tanggal = $request->query('tanggal');
    $tanggal = Carbon::parse($tanggal)->format('Y-m-d');

    $jadwalJanjiTemu = JadwalJanjiTemu::whereDate('waktu_mulai', '=', $tanggal)
        ->select('id', 'waktu_mulai', 'waktu_selesai', 'kuota')
        ->orderBy('waktu_mulai', 'asc')
        ->get();
    
    return response()->json($jadwalJanjiTemu);
}
}