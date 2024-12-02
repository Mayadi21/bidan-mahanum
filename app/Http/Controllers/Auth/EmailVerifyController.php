<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerifyController extends Controller
{
    public function notice(){
        return view('auth.verify-email', [
            'page' => 'Verify Email',
        ]);
    }

    public function verify(EmailVerificationRequest $request){
        $request->fulfill();

        return redirect('/')->with('status', 'Your email has been verified!');
    }

    public function send(){
        auth()->user()->sendEmailVerificationNotification();
 
        return back()->with('message', 'Verification link sent!');
    }

    // public function verify(EmailVerificationRequest $request){
    //     if ($request->user()->hasVerifiedEmail()) {
    //         return redirect('/')->with('message', 'Email already verified!');
    //     }
    //     if ($request->user()->markEmailAsVerified()) {
    //         return redirect('/')->with('message', 'Email verified!');
    //     }
    // }

    // public function verify(Request $request)
    // {
    //     $request->user()->sendEmailVerificationNotification();
    //     return back()->with('message', 'Verification link sent!');
    // }
}
