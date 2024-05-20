<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCommentReportsController extends Controller
{
    public function index()
    {
        return view('dashboard.admin-report', [
            'page' => 'Comment Reports',
            'active' => 'admin-comment-reports'
        ]);
    }

    public function show()
    {
        // JANGAN DIGANTI VIEWNYA
        return view('dashboard.comments.show', [
            'page' => 'Comment Reports',
            'active' => 'admin-comment-reports'
        ]);
    }

    public function hide()
    {
        //
    }
}
