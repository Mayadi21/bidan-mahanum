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

        return view('blog.profile.index', [
            'page' => 'Profile',
            'user' => $user
        ]);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('blog.profile.edit', [
            'page' => 'Edit Profile',
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
    
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'bio' => 'nullable|string|max:500',
            'image' => 'image|file|max:2048',
        ];
    
        // Validasi input
        $request->validate($rules);
    
        // Cek apakah ada perubahan pada profil
        if ($request->name == $user->name && $request->username == $user->username && $request->bio == $user->bio && !$request->hasFile('image')) {
            // Tidak ada perubahan yang dilakukan
            return redirect()->route('profile.index')->with('info', 'No changes were made to your profile.');
        }
    
        // Update informasi profil
        $user->name = $request->name;
        $user->username = $request->username;
        $user->bio = $request->bio;
    
        // Handle file gambar
        if ($request->file('image')) {
            // Hapus foto lama jika ada
            if ($user->image) {
                Storage::delete($user->image);
            }
            // Simpan gambar baru
            $user->image = $request->file('image')->store('user-images');
        }

        // Simpan perubahan ke dalam database
        $user->save();
    
        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }    
}
