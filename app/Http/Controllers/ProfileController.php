<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('blog.profile.index', [
            'page' => 'Profile',
        ]);
    }

    public function edit()
    {
        return view('blog.profile.edit', [
            'page' => 'Edit Profile',
        ]);
    }

    public function update()
    {
        //
    }
}
