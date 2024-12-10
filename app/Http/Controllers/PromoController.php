<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Layanan;
use App\Models\Promo;
use App\Models\PasienTidakTerdaftar;
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
}
