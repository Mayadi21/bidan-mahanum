<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Database\QueryException;

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
        try {
            // Validasi input dari form
            $validated = $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email:dns', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required', 'string'],
                'alamat' => ['nullable', 'string', 'max:255'],
                'tanggal_lahir' => ['required', 'date'],
                'pekerjaan' => ['nullable', 'string', 'max:255'],
                'no_hp' => ['nullable', 'string', 'max:20', 'unique:users,no_hp'],
            ]);
    
            // Hash password sebelum menyimpan
            $validated['password'] = Hash::make($validated['password']);
    
            // Set nilai default untuk status dan role
            $validated['status'] = 'aktif';
            $validated['role'] = 'user';
    
            // Simpan data pengguna ke database
            $user = User::create($validated);
    
            // Memicu event untuk pengguna baru
            event(new Registered($user));
    
            // Login otomatis untuk pengguna yang baru mendaftar
            Auth::login($user);
    
            // Redirect ke halaman yang sesuai setelah login
            return redirect(route('verification.notice'));
        } catch (QueryException $e) {
            // Jika error duplicate entry terjadi, tangani secara manual
            if ($e->getCode() === '23000') { // Kode error untuk integrity constraint violation
                return back()
                    ->withErrors([
                        'email' => 'Email atau nomor HP sudah digunakan. Silakan gunakan yang lain.',
                    ])
                    ->withInput();
            }
    
            // Jika ada error lain, lempar kembali exception-nya
            throw $e;
        }
    }
    
    
}
