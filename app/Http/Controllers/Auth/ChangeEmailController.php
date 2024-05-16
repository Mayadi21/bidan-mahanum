<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangeEmailController extends Controller
{
    public function change()
    {
        return view('auth.change-email', [
            'page' => 'Change Email',
        ]);
    }

    public function check(Request $request)
    {
        if($request->email !== auth()->user()->email){
            return redirect()->back()->withErrors(['email' => 'Email not match!']);
        }

        return view('auth.update-email', [
            'page' => 'Change Email',
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        auth()->user()->update([
            'email' => $request->email,
            'email_verified_at' => null
        ]);

        auth()->user()->sendEmailVerificationNotification();

        return redirect(route('verification.notice'));
    }
}
