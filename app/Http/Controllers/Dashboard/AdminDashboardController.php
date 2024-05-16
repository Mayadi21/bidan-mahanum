<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.admin-index', [
            'page' => 'Admin Dashboard',
            'active' => 'admin-dashboard'
        ]);
    }
}
