<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view ('auth.login', [
            'page' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        
            // Cek peran pengguna
            if (Auth()->user()->role == 'admin') {
                return redirect()->route('dashboard.bidan');
            } 
            elseif (Auth()->user()->role == 'pegawai') {
                return redirect()->route('dashboard.bidan');
            }
            else {
                return redirect()->route('dashboard');
            }
        }
        

        return back()->with('loginError', 'Email or password is incorrect!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
