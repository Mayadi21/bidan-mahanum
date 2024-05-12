<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'bio' => 'nullable|string|max:500',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->name == $user->name && $request->username == $user->username && $request->bio == $user->bio && !$request->hasFile('image')) {
            // Tidak ada perubahan yang dilakukan
            return redirect()->route('profile.index')->with('info', 'No changes were made to your profile.');
        }
    
        // Simpan perubahan pada model pengguna
        $user->name = $request->name;
        $user->username = $request->username;
        $user->bio = $request->bio;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = 'images/'.$imageName;
        }
        $user->save();
    
        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
}
