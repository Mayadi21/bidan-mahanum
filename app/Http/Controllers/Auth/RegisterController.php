<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register', [
            'page' => 'Register',
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],             // Nama wajib diisi
            'email' => ['required', 'string', 'email:dns', 'max:255', 'unique:users'], // Email valid dan unik
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Password minimal 8 karakter dan dikonfirmasi
            'password_confirmation' => ['required', 'string'],      // Konfirmasi password wajib
            'alamat' => ['nullable', 'string', 'max:255'],          // Alamat opsional
            'tanggal_lahir' => ['required', 'date'],                // Tanggal lahir wajib diisi dan harus berupa tanggal yang valid
            'pekerjaan' => ['nullable', 'string', 'max:255'],       // Pekerjaan opsional
            'no_hp' => ['nullable', 'string', 'max:20'],            // Nomor HP opsional
        ]);
    
        // Hash password sebelum menyimpan
        $validated['password'] = Hash::make($validated['password']);
        
        // Set nilai default untuk status dan role
        $validated['status'] = 'aktif'; // Status pengguna otomatis aktif
        $validated['role'] = 'user';   // Default role adalah user
    
        // Simpan data pengguna ke database
        $user = User::create($validated);
    
        // Memicu event untuk pengguna baru
        event(new Registered($user));
    
        // Login otomatis untuk pengguna yang baru mendaftar
        Auth::login($user);
    
        // Redirect ke halaman yang sesuai setelah login
        return redirect()->route('dashboard');  // Gantilah 'dashboard' dengan rute yang sesuai dengan aplikasi Anda
    }
    
    
}
