<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Layanan;
use App\Models\Promo;
use App\Models\JanjiTemu;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    // Menampilkan halaman daftar promo
    public function index()
    {
        $promo = Promo::with('layanan')->get(); // Mengambil semua promo beserta layanan terkait

        return view('dashboard.promo.index', [
            'page' => 'Halaman Promo',
            'active' => 'admin-promo',
            'promo' => $promo  
        ]);
    }

    // Menampilkan halaman formulir tambah promo
    public function create()
    {
        $layanan = Layanan::aktif()->get(); // Mengambil semua layanan
        return view('dashboard.promo.create', [
            'page' => 'Tambah Promo',
            'active' => 'admin-promo',
            'layanan' => $layanan  
        ]);
    }

    // Fungsi untuk menambah promo
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'judul_promo' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'layanan_id' => 'required|exists:layanan,id',
            'diskon' => 'required|integer|min:0',  // Pemotongan harga, bukan persen
            'kuota' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Menyimpan promo baru ke database
        Promo::create([
            'judul_promo' => $request->judul_promo,
            'deskripsi' => $request->deskripsi,
            'layanan_id' => $request->layanan_id,
            'diskon' => $request->diskon,
            'kuota' => $request->kuota,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        // Redirect ke halaman daftar promo setelah data berhasil disimpan
        return redirect()->route('promo.index')->with('success', 'Promo berhasil ditambahkan!');
    }

    // Metode untuk menampilkan detail promo
    public function show($id)
    {
        // Ambil promo berdasarkan ID
        $promo = Promo::with('layanan')->findOrFail($id);

        // Tampilkan view detail promo
        return view('dashboard.promo.show', [
            'page' => 'Tambah Promo',
            'active' => 'admin-promo',
            'promo' => $promo  
        ]);
    }

    // Metode untuk menampilkan formulir pendaftaran pasien
    public function halamanDaftarPromo($id)
    {
        $promo = Promo::findOrFail($id);
        $patients = User::aktif()->role('user')->get(); // Ambil semua pasien yang terdaftar
        return view('dashboard.promo.register-pasien', [
            'page' => 'Daftarkan ke Promo',
            'active' => 'admin-promo',
            'promo' => $promo  ,
            'patients' => $patients  
        ]);
    }


    public function registerPatient(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'id_pasien' => 'required|exists:users,id',
            'keterangan' => 'nullable|string',
        ]);

        // Ambil data promo berdasarkan ID
        $promo = Promo::findOrFail($id);

        // Buat janji temu baru
        JanjiTemu::create([
            'id_pasien' => $validated['id_pasien'],
            'promo_id' => $promo->id,
            'jadwal_id' => null, // Karena jadwal tidak diisi, ini bisa disesuaikan kemudian
            'keluhan' => 'Tidak ada keluhan', // Misalnya default keluhan
            'status' => 'disetujui',
            'keterangan' => $validated['keterangan'],
        ]);

        return redirect()->route('promo.show', $promo->id)
            ->with('success', 'Pasien berhasil didaftarkan untuk promo.');
    }
}
