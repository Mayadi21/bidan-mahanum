<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCommentReportsController extends Controller
{
    public function index()
    {
        return 'index';
        // return view('dashboard.admin.comment-reports.index');
    }
}
