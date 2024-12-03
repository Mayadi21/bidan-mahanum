<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminOrPegawaiMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa jika pengguna bukan 'pegawai' DAN juga bukan 'admin'
        if (!in_array(auth()->user()->role, ['pegawai', 'admin'])) {
            return abort(403); // Akses ditolak jika role tidak sesuai
        }

        return $next($request); // Lanjutkan permintaan jika role sesuai
    }
}
