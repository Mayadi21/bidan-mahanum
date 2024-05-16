<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCommentsController extends Controller
{
    public function index()
    {
        return 'admin comments index';
        // $comments = Comment::with('post')->paginate(10);
        // return view('admin.comments.index', compact('comments'));
    }
}
