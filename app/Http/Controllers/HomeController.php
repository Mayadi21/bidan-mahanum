<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Layanan;
use Illuminate\Http\Request;
use App\Models\Ulasan;

class HomeController extends Controller
{
    public function index()
{
    // Mengambil layanan yang statusnya 'aktif'
    $layanan = Layanan::aktif()->get(); // Menggunakan scope isActive untuk mengambil layanan aktif

    // Mengambil ulasan untuk layanan yang aktif
    $ulasan = Ulasan::with(['user', 'layanan']) // Mengambil data relasi pasien dan layanan
                    ->whereHas('layanan', function ($query) {
                        $query->where('status', 'aktif'); // Filter layanan yang aktif
                    })
                    ->take(10)
                    ->get();

    // Mengirimkan data layanan dan ulasan ke home.blade.php
    return view('blog.home', [
        'page' => 'Home',
        'title' => 'Home',
        'active' => 'home',
        'layanan' => $layanan, // Mengirimkan data layanan
        'ulasan' => $ulasan,   // Mengirimkan data ulasan
    ]);
}


    public function about()
    {
        return view('blog.about', [
            'page' => 'About',
            'title' => 'About',
            'active' => 'about'
        ]);
    }

    public function banned()
    {
        if (auth()->check() && auth()->user()->report_id !== null) {
            $user = auth()->user();
            return view('blog.banned', [
                'page' => 'Banned',
                'title' => 'Banned',
                'active' => 'banned',
                'report_name' => $user->report->report_name,
                'report_description' => $user->report->report_description,
            ]);
        }

        return redirect()->route('home');
    }
}
