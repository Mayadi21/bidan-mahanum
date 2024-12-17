<?php

namespace App\Http\Controllers;

use App\Models\Rujukan;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF
use Illuminate\Support\Facades\DB;


class RujukanController extends Controller
{
    public function index()
    {
        $rujukans = Rujukan::with('user')->get();
        $pasien = User::all();

        return view('dashboard.rujukan.index', [
            'page' => 'Halaman Rujukan',
            'active' => 'admin-rujukan',
            'rujukans' => $rujukans,
            'pasien' => $pasien
        ]);
    }

    public function create()
    {
        return view('rujukan.create');
    }

    public function store(Request $request)
    {
        DB::statement("SET @modifier_id = ?", [auth()->id()]);

        $validated = $request->validate([
            'id_pasien' => 'required|exists:users,id',
            'tanggal_rujukan' => 'required|date',
            'tujuan_rujukan' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        Rujukan::create($validated);
        return redirect()->route('admin.rujukan.index')->with('success', 'Rujukan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $rujukan = Rujukan::findOrFail($id);
        return view('rujukan.edit', compact('rujukan'));
    }

    public function update(Request $request, $id)
    {
        DB::statement("SET @modifier_id = ?", [auth()->id()]);

        $validated = $request->validate([
            'id_pasien' => 'required|exists:users,id',
            'tanggal_rujukan' => 'required|date',
            'tujuan_rujukan' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $rujukan = Rujukan::findOrFail($id);
        $rujukan->update($validated);

        return redirect()->route('admin.rujukan.index')->with('success', 'Rujukan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rujukan = Rujukan::findOrFail($id);
        $rujukan->delete();

        return redirect()->route('admin.rujukan.index')->with('success', 'Rujukan berhasil dihapus!');
    }
    public function cetak($id)
{
    $rujukan = Rujukan::with('user')->findOrFail($id);

    $pdf = Pdf::loadView('dashboard.rujukan.surat', compact('rujukan'))->setPaper('a4', 'portrait');

    // Pastikan untuk memberikan nama file yang sesuai
    return $pdf->stream('Surat_Rujukan_' . $rujukan->id . '.pdf');
}

}
