<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class AdminCommentsController extends Controller
{
    public function index()
    {
        return view('dashboard.comments.index', [
            'page' => 'All Comments',
            'active' => 'admin-comments',
            'comments' => Comment::latest()->paginate(10),
        ]);
    }

    public function show(Comment $comment)
    {
        return view('dashboard.comments.show', [
            'page' => 'Comment Details',
            'active' => 'admin-comments',
            'comment' => $comment,
        ]);
    }

    public function hide(Comment $comment)
    {
        //
    }
}
