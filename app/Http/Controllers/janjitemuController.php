<?php

namespace App\Http\Controllers;

use App\Models\JanjiTemu;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    // Simpan janji temu dengan menambahkan id_pasien dan waktu_janji yang sudah digabungkan
    JanjiTemu::create([
        'id_pasien' => auth()->id(),  // id pengguna yang sedang login
        'waktu_janji' => $waktuJanji,  // Menggunakan waktu gabungan
        'keluhan' => $validated['keluhan'] ?? null,
        'status' => 'menunggu konfirmasi',  // Status awal
    ]);

        return redirect()->route('janji.temu' , ['idPasien' => auth()->id()])->with('success', 'Janji temu berhasil dibuat!');
    }
}
