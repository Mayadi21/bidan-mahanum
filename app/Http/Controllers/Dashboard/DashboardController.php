<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $idUser = Auth::id();

        // Query ke view_kunjungan_pasien untuk data berdasarkan id_pasien
        $riwayatKunjungan = DB::table('view_kunjungan_pasien')
            ->where('id_pasien', $idUser)
            ->get();

        $janjiTemu = DB::table('view_jadwal_janji_temu')->where('id_pasien', $idUser)->where('status', 'disetujui')->get(); // Mengambil semua data janji temu hari ini

        return view('dashboard.index', [
            'page' => auth()->user()->nama,
            'active' => 'dashboard',
            'kunjungan' => $riwayatKunjungan,   
            'janjiTemu' => $janjiTemu         
        ]);
    }
}
