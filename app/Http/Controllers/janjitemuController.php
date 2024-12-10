<?php

namespace App\Http\Controllers;

use App\Models\JanjiTemu;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;


class JanjiTemuController extends Controller
{

public function store(Request $request)
{
    // Validasi form
    $validated = $request->validate([
        'tanggal' => 'required|date',
        'waktu' => 'required|date_format:H:i',
        'keluhan' => 'nullable|string',
    ]);

    // Gabungkan tanggal dan waktu menjadi datetime
    $waktuJanji = Carbon::parse($validated['tanggal'] . ' ' . $validated['waktu'])->format('Y-m-d H:i:s');

    try {
        // Simpan janji temu dengan menambahkan id_pasien dan waktu_janji yang sudah digabungkan
        JanjiTemu::create([
            'id_pasien' => auth()->id(),  // id pengguna yang sedang login
            'waktu_janji' => $waktuJanji,  // Menggunakan waktu gabungan
            'keluhan' => $validated['keluhan'] ?? null,
            'status' => 'menunggu konfirmasi',  // Status awal
        ]);
    
        // Redirect dengan pesan sukses jika berhasil
        return redirect()->route('janji.temu' , ['idPasien' => auth()->id()])->with('success', 'Janji temu berhasil dibuat!');
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

}


