<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use App\Models\User;
use App\Models\Layanan;
use Illuminate\Database\QueryException;

class UlasanController extends Controller
{
    public function index()
    {
        // Mengambil ulasan untuk layanan yang aktif
        $ulasan = Ulasan::with(['user', 'layanan']) // Mengambil data relasi pasien dan layanan
                        ->whereHas('layanan', function($query) {
                            $query->where('status', 'aktif'); // Filter layanan yang aktif
                        })
                        ->get();

        // Menampilkan ulasan di view
        return view('dashboard.ulasan.index', [
            'ulasan' => $ulasan,
            'page' => 'Halaman Ulasan',
            'active' => 'admin-ulasan',
        ]);
    }

    public function store(Request $request, $layananId)
    {
        // Validasi input
        $request->validate([
            'ulasan' => 'required|string|max:255',
        ]);

        // Ambil layanan yang dimaksud
        $layanan = Layanan::findOrFail($layananId);

        // Simpan ulasan
        Ulasan::create([
            'id_pengguna' => Auth::id(),
            'layanan_id' => $layanan->id,
            'ulasan' => $request->ulasan,
            'status' => 'aktif', // Status aktif, bisa diubah jika diperlukan
        ]);

        // Redirect ke halaman layanan dengan pesan sukses
        return redirect()->route('layanan.show', $layanan->id)->with('success', 'Ulasan berhasil diberikan.');
    }

// Metode untuk memblokir ulasan (mengubah status menjadi tidak aktif)
public function block(Ulasan $ulasan)
{
    $ulasan->update(['status' => 'tidak aktif']);

    return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil diblokir.');
}

// Metode untuk mengaktifkan ulasan (mengubah status menjadi aktif)
public function activate(Ulasan $ulasan)
{
    $ulasan->update(['status' => 'aktif']);

    return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil diaktifkan.');
}


public function update(Request $request, $id)
{
    $request->validate([
        'ulasan' => 'required|string',
    ]);

    $ulasan = Ulasan::findOrFail($id);

    if ($ulasan->id_pengguna !== auth()->id()) {
        return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit ulasan ini.');
    }

    $ulasan->update([
        'ulasan' => $request->ulasan,
    ]);

    return redirect()->back()->with('success', 'Ulasan berhasil diperbarui.');
}




}

