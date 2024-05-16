<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // return 'ini halaman dashboard user';
        return view('dashboard.index', [
            'page' => auth()->user()->name,
            'active' => 'dashboard'
        ]);
    }
}
