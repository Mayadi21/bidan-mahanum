<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function index()
    {
        return view('dashboard.comments.index', [
            'page' => 'Comments',
            'active' => 'comments'
        ]);
    }

    public function show(Comment $comment)
    {
        return view('dashboard.comments.show', [
            'page' => 'Comment Show',
            'active' => 'comments',
        ]);
    }

    public function destroy(Comment $comment)
    {
        //
    }
}
