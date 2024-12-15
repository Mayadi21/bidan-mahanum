<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Layanan;
use App\Models\Promo;
use App\Models\DetailPromo;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    // Menampilkan halaman daftar promo
    public function index()
    {
        // Mengambil data promo beserta detail promonya
        // $promo = Promo::with('layanan') // Relasi ke tabel layanan
        // ->with([
        //     'detailPromo' => function ($query) {
        //         $query->select(
        //             'promo_id',
        //             DB::raw('MIN(tanggal) as tanggal_mulai'), // Tanggal mulai promo
        //             DB::raw('MAX(tanggal) as tanggal_selesai') // Tanggal selesai promo
        //         )
        //         ->groupBy('promo_id');
        //     }
        // ])
        // ->get()
        // ->map(function ($promo) {
        //     $jadwal = $promo->jadwal->first();
        //     $promo->tanggal_mulai = $jadwal ? $jadwal->tanggal_mulai : null;
        //     $promo->tanggal_selesai = $jadwal ? $jadwal->tanggal_selesai : null;
        //     return $promo;
        // });
        // $promo = Promo::with(['layanan', 'detailPromo'])->get();
        $promo = DB::table('promo_view')->get();

    
        return view('dashboard.promo.index', [
            'page' => 'Halaman Promo',
            'active' => 'admin-promo',
            'promo' => $promo  
        ]);
    }

//     public function index()
// {
//     // Mengambil data promo beserta layanan, tanggal mulai, dan tanggal selesai
//     $promo = Promo::with('layanan') // Relasi ke tabel layanan
//         ->with([ // Sub-query untuk tanggal mulai dan selesai
//             'detailPromo' => function ($query) {
//                 $query->select(
//                     'promo_id',
//                     DB::raw('MIN(tanggal) as tanggal_mulai'), // Tanggal mulai promo
//                     DB::raw('MAX(tanggal) as tanggal_selesai') // Tanggal selesai promo
//                 )
//                 ->groupBy('promo_id');
//             }
//         ])
//         ->get()
//         ->map(function ($promo) {
//             // Menambahkan properti tanggal_mulai dan tanggal_selesai dari jadwal
//             $jadwal = $promo->jadwal->first();
//             $promo->tanggal_mulai = $jadwal ? $jadwal->tanggal_mulai : null;
//             $promo->tanggal_selesai = $jadwal ? $jadwal->tanggal_selesai : null;
//             return $promo;
//         });

    // return view('dashboard.promo.index', [
    //     'page' => 'Halaman Promo',
    //     'active' => 'admin-promo',
    //     'promo' => $promo
    // ]);
    // }


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

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul_promo' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'layanan_id' => 'required|exists:layanan,id',
            'diskon' => 'required|numeric|min:0',
            'kuota' => 'required|numeric|min:1',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);
    
        // Menyimpan data promo
        $promo = new Promo();
        $promo->judul_promo = $validated['judul_promo'];
        $promo->deskripsi = $validated['deskripsi'];
        $promo->layanan_id = $validated['layanan_id'];
        $promo->diskon = $validated['diskon'];
        $promo->save();
    
        // Hitung jumlah hari antara tanggal mulai dan tanggal selesai
        $startDate = \Carbon\Carbon::parse($validated['tanggal_mulai']);
        $endDate = \Carbon\Carbon::parse($validated['tanggal_selesai']);
        $days = $startDate->diffInDays($endDate) + 1; // Jumlah hari promo
        $quotaPerDay = $validated['kuota'] / $days;
    
        // Menyimpan detail promo untuk setiap hari
        for ($i = 0; $i < $days; $i++) {
            $detailPromo = new DetailPromo();
            $detailPromo->promo_id = $promo->id;
            $detailPromo->tanggal = $startDate->addDay()->format('Y-m-d'); // Tanggal setiap hari
            $detailPromo->kuota = ($i == $days - 1) ? ceil($quotaPerDay) : floor($quotaPerDay); // Membagi kuota dengan rata
            $detailPromo->save();
        }
    
        // Redirect atau beri respons sukses
        return redirect()->route('promo.index')->with('success', 'Promo berhasil ditambahkan!');
    }
    

    // public function store(Request $request)
    // {
    //     // Validasi input dari form
    //     $validatedData = $request->validate([
    //         'judul_promo' => 'required|string|max:255',
    //         'deskripsi' => 'required|string',
    //         'layanan_id' => 'required|exists:layanan,id',
    //         'diskon' => 'required|integer|min:0',
    //         'kuota' => 'required|integer|min:1',
    //         'tanggal_mulai' => 'required|date',
    //         'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    //     ]);
    
    //     // Buat data promo baru
    //     $promo = Promo::create([
    //         'judul_promo' => $validatedData['judul_promo'],
    //         'deskripsi' => $validatedData['deskripsi'],
    //         'layanan_id' => $validatedData['layanan_id'],
    //         'diskon' => $validatedData['diskon'],
    //     ]);
    
    //     // Hitung tanggal mulai, selesai, dan rentang hari
    //     $tanggalMulai = Carbon::parse($validatedData['tanggal_mulai']);
    //     $tanggalSelesai = Carbon::parse($validatedData['tanggal_selesai']);
    //     $jumlahHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1;

    
    //     // Hitung kuota per hari dan sisa kuota
    //     $kuotaTotal = $validatedData['kuota'];
    //     $kuotaPerHari = intdiv($kuotaTotal, $jumlahHari);
    //     $sisaKuota = $kuotaTotal % $jumlahHari;
    
    //     // Loop untuk menyimpan detail promo berdasarkan rentang tanggal
    //     for ($i = 0; $i < $jumlahHari; $i++) {
    //         $kuotaHariIni = $kuotaPerHari;
    
    //         // Tambahkan sisa kuota ke hari terakhir
    //         if ($i == $jumlahHari - 1) {
    //             $kuotaHariIni += $sisaKuota;
    //         }
    
    //         // Simpan detail promo
    //         DetailPromo::create([
    //             'promo_id' => $promo->id,
    //             'kuota' => $kuotaHariIni,
    //             'tanggal' => $tanggalMulai->copy()->addDays($i)->toDateString(),
    //         ]);
    //     }
    
    //     // Redirect ke halaman daftar promo dengan pesan sukses
    //     return redirect()->route('promo.index')->with('success', 'Promo berhasil ditambahkan!');
    // }
    
    

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
