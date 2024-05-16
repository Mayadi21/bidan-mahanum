<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminReportsController extends Controller
{
    public function index()
    {
        return 'admin reports';
        // return view('dashboard.admin.reports.index');
    }
}
