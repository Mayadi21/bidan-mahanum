<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCommentsController extends Controller
{
    public function index()
    {
        return view('dashboard.comments.index', [
            'page' => 'All Comments',
            'active' => 'admin-comments',
        ]);
    }

    public function show()
    {
        return view('dashboard.comments.show', [
            'page' => 'Comment Details',
            'active' => 'admin-comments',
        ]);
    }
}
