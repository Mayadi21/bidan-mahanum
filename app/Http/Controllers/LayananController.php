<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\Ulasan;



class LayananController extends Controller
{
    public function index()
    {
    // Cek role pengguna
    if (!auth()->check() || auth()->user()->role === 'user') {
        $layanan = DB::table('layanan')->where('status', 'aktif')->get();
    } else {
        $layanan = DB::table('layanan')->get();

    }

        return view('dashboard.layanan.index', [
            'page' => 'Layanan',
            'active' => 'layanan',
            'layanan' => $layanan    
        ]);
    }

    // Menampilkan detail layanan
    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);  // Ambil layanan berdasarkan ID
        $ulasan = Ulasan::with('user')->where('layanan_id', $id)->where('status', 'aktif')->orderBy('tanggal_ulasan', 'desc')->get(); // Ambil semua ulasan terkait

        return view('dashboard.layanan.show', [
            'page' => 'Layanan',
            'active' => 'layanan',
            'layanan' => $layanan ,   
            'ulasan' => $ulasan    
        ]);
    }

    // Menampilkan form untuk mengedit layanan (hanya untuk admin)
    public function edit($id)
    {

        $layanan = DB::table('layanan')->where('id', $id)->first();

        return view('dashboard.layanan.edit', [
            'page' => 'Edit Layanan',
            'active' => 'layanan',
            'layanan' => $layanan    
        ]);
    }

    // Menampilkan form tambah layanan
    public function create()
    {
        return view('dashboard.layanan.create', [
            'page' => 'Buat Layanan',
            'active' => 'layanan',
        ]);
    }

    // Menyimpan layanan baru ke database
    public function store(Request $request)
{
    
    // Validasi input
    $request->validate([
        'gambar' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048', // Gambar menjadi opsional
        'jenis_layanan' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'deskripsi' => 'nullable|string',
    ]);
    
    // Default value untuk path gambar
    $filePath = null;
    
    // Proses file gambar jika diunggah
    if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $fileName);
        $filePath = 'images/' . $fileName; // Path gambar yang akan disimpan
    }
    
    // Menyimpan data layanan ke database
    Layanan::create([
        'gambar' => $filePath, // Bisa null jika gambar tidak diunggah
        'jenis_layanan' => $request->jenis_layanan,
        'harga' => $request->harga,
        'deskripsi' => $request->deskripsi,
        'status' => 'aktif', // Status default
    ]);
    DB::statement("SET @modifier_id = ?", [auth()->id()]);
    
    // Redirect atau return response sesuai kebutuhan
    return redirect()->route('layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
}


    // Melakukan update layanan (hanya untuk admin)
    public function update(Request $request, $id)
    {
        DB::statement("SET @modifier_id = ?", [auth()->id()]);
        $request->validate([
            'jenis_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'besar_bonus' => 'required|integer|min:0',
            'gambar' => 'nullable|image',
        ]);
        // Update data layanan
        DB::table('layanan')->where('id', $id)->update([
            'jenis_layanan' => $request->jenis_layanan,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'besar_bonus' => $request->besar_bonus,
            'gambar' => $request->gambar,  // Pastikan gambar ditangani sesuai kebutuhan
        ]);

        return redirect()->route('layanan.show', $id)->with('success', 'Layanan berhasil diperbarui.');
    }

    public function nonaktifkan($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->status = 'tidak aktif'; // Ubah status menjadi tidak aktif
        $layanan->save(); // Simpan perubahan
    
        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil dinonaktifkan.');
    }

    public function aktifkan($id)
    {
        // Update status layanan menjadi aktif
        $layanan = Layanan::findOrFail($id);
        $layanan->update(['status' => 'aktif']);
        $layanan->save(); // Simpan perubahan

        return redirect()->route('layanan.index')->with('success', 'Layanan berhasil diaktifkan.');
    }
    
}