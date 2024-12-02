<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('profile.index', [
            'page' => 'Profile',
            'active' => null,
            'user' => $user
        ]);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('blog.profile.edit', [
            'page' => 'Edit Profile',
            'active' => null,
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|unique:users,no_hp,' . $id,
            'alamat' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
        ]);
    
        $user = User::findOrFail($id);
        $user->update($request->all());
    
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
    
    
    //     // Redirect ke halaman profil dengan pesan sukses
    //     return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    // }    
}
