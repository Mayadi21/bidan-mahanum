<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\JanjiTemu;
use App\Models\User;
use Illuminate\Database\QueryException;



class AdminJanjiTemuController extends Controller
{
    /**
     * Display a listing of appointments.
     */
    public function index()
    {   
        $users = User::aktif()->role('user')->get();

        // Ambil data dari view
        $jadwalJanjiTemuQuery = DB::table('view_jadwal_janji_temu');
    
        // Filter berdasarkan status
        if (request('status')) {
            $jadwalJanjiTemuQuery = $jadwalJanjiTemuQuery->where('status', request('status'));
        }
    
        // Filter pencarian berdasarkan nama pasien atau keluhan
        if (request('search')) {
            $search = request('search');
            $jadwalJanjiTemuQuery = $jadwalJanjiTemuQuery->where(function ($query) use ($search) {
                $query->where('pasien_nama', 'like', '%' . $search . '%')
                      ->orWhere('keluhan', 'like', '%' . $search . '%');
            });
        }
    
        return view('dashboard.admin-janjitemu.index', [
            'page' => 'Halaman Janji Temu',
            'active' => 'admin-janjitemu',
            'janjiTemu' => $jadwalJanjiTemuQuery->get(),
            'users' => $users
        ]);
    }
    
    
/**
     * Menyimpan janji temu baru
     */

     public function store(Request $request)
     {
         // Validasi input
         $validated = $request->validate([
             'id_pasien' => 'required|exists:users,id',
             'keluhan' => 'nullable|string|max:255',
             'waktu_janji' => 'required|date',
         ]);
     
         try {
             // Menyimpan data janji temu
             JanjiTemu::create([
                 'id_pasien' => $validated['id_pasien'],
                 'keluhan' => $validated['keluhan'],
                 'waktu_janji' => $validated['waktu_janji'],
                 'status' => 'disetujui',
             ]);
     
             // Redirect dengan pesan sukses jika berhasil
             return redirect()->route('janjitemu.index')->with('success', 'Janji temu berhasil ditambahkan.');
         } catch (QueryException $e) {
             // Tangkap error dari trigger database
             if ($e->getCode() === '45000') {
                // Proses pesan error untuk mengambil bagian relevan
                $errorMessage = $e->getMessage();
                if (preg_match('/Terjadi kesalahan: \[(.*?)\]/', $errorMessage, $matches)) {
                    $parsedMessage = $matches[1]; // Ambil teks di antara [ dan ]
                } else {
                    $parsedMessage = 'Terjadi kesalahan pada janji temu.';
                }
    
                return redirect()->back()->withInput()->with('error', $parsedMessage);
            }
     
             // Tangkap error lainnya
             return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
         }
     }

    /**
     * Memperbarui status janji temu
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu konfirmasi,disetujui,selesai,ditolak',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $janjiTemu = JanjiTemu::findOrFail($id);

        $janjiTemu->update([
            'status' => $validated['status'],
            'keterangan' => $validated['keterangan'] ?? $janjiTemu->keterangan,
        ]);

        return redirect()->route('janjitemu.index')->with(
            'success',
            'Status janji temu berhasil diperbarui.'
        );
    }
}