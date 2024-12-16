<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Transaksi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $idUser = Auth::id();
    

        
        $totalKunjungan = Transaksi::where('id_pasien', auth()->id())->count();
    
        // Mengambil janji temu yang disetujui
        $janjiTemu = DB::table('view_jadwal_janji_temu')
            ->where('id_pasien', $idUser)
            ->where('status', 'disetujui')
            ->orderBy('waktu_mulai', 'asc') // Pastikan janji temu terdekat diambil lebih dulu
            ->first();
    
        $sisaWaktu = null;
    
        if ($janjiTemu) {
            $waktuJanji = Carbon::parse($janjiTemu->waktu_mulai);
            $sekarang = Carbon::now();
        
            // Periksa apakah $waktuJanji adalah hari ini dengan jam 00:00
            if ($waktuJanji->isToday() && $waktuJanji->isStartOfDay()) {
                $sisaWaktu = 'Janji temu Anda tepat pada hari ini!';
            } else {
                // Menghitung sisa waktu secara detail
                $diffInWeeks = $sekarang->diffInWeeks($waktuJanji);
                $diffInDays = $sekarang->diffInDays($waktuJanji) % 7; // Sisa hari setelah minggu
                $diffInHours = $sekarang->diffInHours($waktuJanji) % 24; // Sisa jam setelah hari
        
                if ($waktuJanji->greaterThan($sekarang)) {
                    $sisaWaktu = "Janji temu dalam " . 
                    ($diffInWeeks ? "$diffInWeeks minggu, " : '') .
                    ($diffInDays ? "$diffInDays hari, " : '') .
                    ($diffInHours ? "$diffInHours jam " : '') . 
                    'lagi!';

                }
            }
        }
        
    
        return view('dashboard.index', [
            'page' => auth()->user()->nama,
            'active' => 'dashboard',
            'janjiTemu' => $janjiTemu,
            'totalKunjungan' => $totalKunjungan,
            'sisaWaktu' => $sisaWaktu, // Kirimkan sisa waktu ke view
        ]);
    }

    public function riwayatKunjungan($idPasien)
    {
        $riwayatKunjungan = DB::table('view_kunjungan_pasien')
            ->where('id_pasien', $idPasien)
            ->get();

        return view('dashboard.riwayat-kunjungan.index', [
            'page' => 'Riwayat Kunjungan',
            'active' => 'riwayat',
            'riwayatKunjungan' => $riwayatKunjungan,

        ]);
    }

    public function janjiTemu($idPasien)
    {
        $janjiTemu = DB::table('view_jadwal_janji_temu')
            ->where('id_pasien', $idPasien)
            ->get();

        return view('dashboard.janjitemu.index', [
            'page' => 'Janji Temu',
            'active' => 'janji',
            'janjiTemu' => $janjiTemu,

        ]);
    }

}
