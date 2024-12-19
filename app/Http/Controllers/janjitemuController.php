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

public function batalkan($id)
{
    // Mulai transaksi untuk memastikan semua operasi berhasil atau gagal bersama
    DB::transaction(function () use ($id) {
        // Ambil janji temu yang ingin dibatalkan
        $janjiTemu = JanjiTemu::findOrFail($id);

        // Cek apakah janji temu memiliki nilai pada jadwal_promo_id
        if ($janjiTemu->jadwal_promo_id) {
            // Ambil detail promo terkait dengan jadwal_promo_id
            $detailPromo = DB::table('detail_promo')
                ->where('id', $janjiTemu->jadwal_promo_id)
                ->first();

            if ($detailPromo) {
                // Kurangi 1 pada kolom terpakai pada detail_promo
                DB::table('detail_promo')
                    ->where('id', $detailPromo->id)
                    ->decrement('terpakai');
            }
        }

        // Hapus janji temu yang dibatalkan
        $janjiTemu->delete();
    });

    return redirect()->route('user.janjitemu.index')->with('success', 'Janji temu berhasil dibatalkan dan kuota diperbarui.');
}




}


