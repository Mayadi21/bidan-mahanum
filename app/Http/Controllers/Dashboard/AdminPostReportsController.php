<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPostReportsController extends Controller
{
    public function index()
    {
        return view('dashboard.admin-report', [
            'page' => 'Post Reports',
            'active' => 'admin-post-reports'
        ]);
    }

    public function show()
    {
        // JANGAN DIGANTI VIEWNYA
        return view('dashboard.posts.show', [
            'page' => 'Post Reports',
            'active' => 'admin-post-reports'
            // 'post' => 
            // 'comments' => 
        ]);
    }

    public function hide()
    {
        //
    }
}
