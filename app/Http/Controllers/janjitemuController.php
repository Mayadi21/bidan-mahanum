<?php

namespace App\Http\Controllers;

use App\Models\JanjiTemu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;


class JanjiTemuController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwal_janji_temu,id',
            'keluhan' => 'required|string|max:255',
        ]);

        // Ambil ID user yang sedang login
        $idPasien = Auth::id();

        try {
            DB::statement("SET @modifier_id = ?", [auth()->id()]);

        // Simpan data ke tabel janji_temu
        JanjiTemu::create([
            'id_pasien' => $idPasien,
            'jadwal_id' => $request->jadwal_id,
            'keluhan' => $request->keluhan,
            'status' => 'menunggu konfirmasi',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Janji temu berhasil didaftarkan. Silakan tunggu konfirmasi.');

        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap pesan error dari trigger
            if ($e->getCode() === '45000') {
                $errorMessage = $e->getPrevious()->getMessage();
            } else {
                $errorMessage = 'Terjadi kesalahan saat menyimpan jadwal.';
            }
    
            // Redirect ke halaman sebelumnya dengan pesan error
            return redirect()->back()->withErrors(['error' => $errorMessage]);
        }
    }

public function jadwalTersedia()
{
    // Ambil jadwal mulai dari hari ini yang belum penuh
    $jadwalTersedia = DB::table('jadwal_janji_temu')
        ->leftJoin('janji_temu', 'jadwal_janji_temu.id', '=', 'janji_temu.jadwal_id')
        ->select('jadwal_janji_temu.id', 'jadwal_janji_temu.waktu_mulai', 'jadwal_janji_temu.waktu_selesai', 'jadwal_janji_temu.kuota', DB::raw('COUNT(janji_temu.id) as total_terisi'))
        ->where('jadwal_janji_temu.waktu_mulai', '>=', Carbon::now())
        ->groupBy('jadwal_janji_temu.id', 'jadwal_janji_temu.waktu_mulai', 'jadwal_janji_temu.waktu_selesai', 'jadwal_janji_temu.kuota')
        ->havingRaw('total_terisi < jadwal_janji_temu.kuota')
        ->get();

    return view('dashboard.janjitemu.jadwal', [
        'page' => 'Halaman Janji Temu Saya',
        'active' => 'user-janjitemu',
        'jadwalTersedia' => $jadwalTersedia
    ]);
}

}


