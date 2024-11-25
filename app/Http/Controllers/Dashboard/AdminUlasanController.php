<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use App\Models\User;
use App\Models\Layanan;
use Illuminate\Database\QueryException;

class AdminUlasanController extends Controller
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

}