<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPostsController extends Controller
{
    public function index()
    {
        return 'hello from the admin posts controller';
        // return view('dashboard.posts.index');
    }
}
