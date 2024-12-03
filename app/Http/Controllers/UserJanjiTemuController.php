<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\JanjiTemu;
use App\Models\User;
use Illuminate\Database\QueryException;

class UserJanjiTemuController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil data janji temu untuk user yang sedang login
        $janjiTemuQuery = DB::table('view_jadwal_janji_temu')
            ->where('id_pasien', $userId);

        // Filter berdasarkan status
        if (request('status')) {
            $janjiTemuQuery = $janjiTemuQuery->where('status', request('status'));
        }

        // Filter pencarian berdasarkan keluhan
        if (request('search')) {
            $search = request('search');
            $janjiTemuQuery = $janjiTemuQuery->where('keluhan', 'like', '%' . $search . '%');
        }

        return view('dashboard.user-janjitemu.index', [
            'page' => 'Halaman Janji Temu Saya',
            'active' => 'user-janjitemu',
            'janjiTemu' => $janjiTemuQuery->get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keluhan' => 'required|string|max:255',
            'waktu_janji' => 'required|date|after:now',
        ]);

        if ($validator->fails()) {
            return redirect()
            ->route('user.janjitemu.index')->with('error', 'Janji temu gagal dibuat.');
        }

        DB::table('janji_temu')->insert([
            'id_pasien' => Auth::id(),
            'keluhan' => $request->keluhan,
            'waktu_janji' => $request->waktu_janji,
            'status' => 'menunggu konfirmasi'
        ]);

        return redirect()->route('user.janjitemu.index')->with('success', 'Janji temu berhasil dibuat dan sedang menunggu konfirmasi.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'keluhan' => 'required|string|max:255',
            'waktu_janji' => 'required|date|after:now',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $janjiTemu = DB::table('janji_temu')
            ->where('id', $id)
            ->where('id_pasien', Auth::id())
            ->where('status', 'menunggu konfirmasi')
            ->first();

        if (!$janjiTemu) {
            return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit janji temu ini.');
        }

        DB::table('janji_temu')
            ->where('id', $id)
            ->update([
                'keluhan' => $request->keluhan,
                'waktu_janji' => $request->waktu_janji,
            ]);

        return redirect()->route('user.janjitemu.index')->with('success', 'Janji temu berhasil diperbarui.');
    }

}
