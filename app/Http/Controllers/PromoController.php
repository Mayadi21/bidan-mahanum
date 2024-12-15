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
    public function index()
    {   $users = User::aktif()->role('user')->get();
        $promos = DB::table('promo_view')->get();


            return view('dashboard.promo.index', [
                'page' => 'Halaman Promo',
                'active' => 'admin-promo',
                'promos' => $promos ,
                'users' => $users  
            ]);    }


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
    
    // Metode untuk menampilkan detail promo
    public function show($id)
    {
        // Ambil promo berdasarkan ID
        $promo = DB::table('promo_view')->where('promo_id', $id)->first();

        // Tampilkan view detail promo
        return view('dashboard.promo.show', [
            'page' => 'Tambah Promo',
            'active' => 'admin-promo',
            'promo' => $promo  
        ]);
    }


//     // Menampilkan form pendaftaran pasien ke promo
//     public function showDaftarPasienForm($promoId)
//     {
//         // Ambil data promo berdasarkan promoId
//         $promo = Promo::findOrFail($promoId);
//         // Ambil semua pasien (users)
//         $users = User::aktif()->role('user')->get(); // Ambil semua pasien yang terdaftar

//         return view('dashboard.promo.register-pasien', [
//             'page' => 'Daftarkan ke Promo',
//             'active' => 'admin-promo',
//             'promo' => $promo  ,
//             'users' => $users  
//         ]);    }


//     public function registerPatient(Request $request, $id)
//     {
//         // Validasi input
//         $validated = $request->validate([
//             'id_pasien' => 'required|exists:users,id',
//             'keterangan' => 'nullable|string',
//         ]);

//         // Ambil data promo berdasarkan ID
//         $promo = Promo::findOrFail($id);

//         // Buat janji temu baru
//         JanjiTemu::create([
//             'id_pasien' => $validated['id_pasien'],
//             'promo_id' => $promo->id,
//             'jadwal_id' => null, // Karena jadwal tidak diisi, ini bisa disesuaikan kemudian
//             'keluhan' => 'Tidak ada keluhan', // Misalnya default keluhan
//             'status' => 'disetujui',
//             'keterangan' => $validated['keterangan'],
//         ]);

//         return redirect()->route('promo.show', $promo->id)
//             ->with('success', 'Pasien berhasil didaftarkan untuk promo.');
//     }


//     public function daftarPasien(Request $request, $promoId)
// {
//     // Validasi input
//     $validated = $request->validate([
//         'pasien_id' => 'required|exists:users,id',
//     ]);

//     $pasienId = $validated['pasien_id'];

//     // Hitung kuota terpakai untuk promo ini dengan menghitung janji temu yang sudah terdaftar
//     $kuotaTerpakai = DB::table('janji_temu')
//         ->where('jadwal_promo_id', $promoId)
//         ->where('status', '!=', 'ditolak') // Mengabaikan janji temu yang ditolak
//         ->count();

//     // Ambil detail promo berdasarkan promoId
//     $detailPromo = DB::table('detail_promo')
//         ->where('promo_id', $promoId)
//         ->orderBy('tanggal', 'asc')
//         ->get();

//     // Cek sisa kuota dan tentukan jadwal yang akan didaftarkan
//     foreach ($detailPromo as $promo) {
//         // Hitung kuota yang sudah terpakai untuk detail promo ini
//         $totalTerdaftar = DB::table('janji_temu')
//             ->where('jadwal_promo_id', $promo->id)
//             ->count();

//         // Hitung sisa kuota untuk promo ini
//         $sisaKuota = $promo->kuota - $totalTerdaftar;

//         // Jika ada sisa kuota, daftarkan pasien ke detail promo ini
//         if ($sisaKuota > 0) {
//             DB::table('janji_temu')->insert([
//                 'id_pasien' => $pasienId,
//                 'jadwal_promo_id' => $promo->id,
//                 'keluhan' => $request->keluhan,
//                 'status' => 'menunggu konfirmasi', // Atur status sesuai kebutuhan
//                 'keterangan' => $request->keterangan,
//             ]);

//             return redirect()->route('promo.detail', ['promoId' => $promoId])
//                              ->with('success', 'Pasien berhasil didaftarkan ke promo.');
//         }
//     }

//     return redirect()->back()->with('error', 'Tidak ada kuota yang tersedia untuk promo ini.');
// }


public function register(Request $request)
{
    // Validasi input
    $request->validate([
        'promo_id' => 'required|exists:promo,id',
        'id_pasien' => 'required|exists:users,id',
    ]);

    $promoId = $request->promo_id;

    // 1. Hitung banyak janji temu dengan foreign key ke promo ini
    $jumlahJanjiTemu = DB::table('janji_temu')
        ->where('jadwal_promo_id', $promoId)
        ->count();

    // 2. Panggil fungsi MySQL untuk menghitung sisa kuota promo
    $sisaKuota = DB::selectOne("SELECT sisa_kuota_promo(?) AS sisa_kuota", [$promoId])->sisa_kuota;

    // Cek apakah sisa kuota masih tersedia
    if ($sisaKuota <= 0) {
        return redirect()->back()->with('error', 'Kuota promo telah penuh, pasien tidak dapat didaftarkan.');
    }

    // 3. Cari detail promo yang masih memiliki slot tersisa (terpakai < kuota)
    $detailPromo = DB::table('detail_promo')
        ->where('promo_id', $promoId)
        ->whereColumn('terpakai', '<', 'kuota')
        ->orderBy('tanggal', 'asc')
        ->first();

    // Jika tidak ada slot tersisa, kembalikan pesan error
    if (!$detailPromo) {
        return redirect()->back()->with('error', 'Semua slot promo telah penuh.');
    }

    try {
        // 4. Simpan janji temu dan tambahkan id detail promo di kolom jadwal_promo_id
        DB::transaction(function () use ($request, $detailPromo) {
            // Simpan janji temu
            DB::table('janji_temu')->insert([
                'id_pasien' => $request->id_pasien,
                'jadwal_promo_id' => $detailPromo->id,
                'status' => 'disetujui',
                'keterangan' => null,
            ]);

            // Update jumlah "terpakai" pada detail_promo
            DB::table('detail_promo')
                ->where('id', $detailPromo->id)
                ->increment('terpakai');
        });

        return redirect()->back()->with('success', 'Pasien berhasil didaftarkan ke promo.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat mendaftarkan pasien: ' . $e->getMessage());
    }
}

}
