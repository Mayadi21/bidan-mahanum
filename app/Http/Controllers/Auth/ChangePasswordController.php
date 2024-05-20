<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function index()
    {
        return view('auth.change-password', [
            'page' => 'Change Password',
        ]);
    }

    public function update(Request $request)
    {
        if (!password_verify($request->current_password, auth()->user()->password)) {
            return back()->with('error', 'Your current password does not match with the password you provided. Please try again.');
        }

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('profile.index')->with('password-success', 'Your password has been changed.');
    }
}
