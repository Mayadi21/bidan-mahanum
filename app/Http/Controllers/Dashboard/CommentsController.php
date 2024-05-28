<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;


class CommentsController extends Controller
{
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil komentar yang berasal dari post yang dimiliki oleh pengguna yang sedang login
        $comments = Comment::whereHas('post', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->whereNull('comments.report_id')
        ->whereHas('user', function ($query) {
            $query->whereNull('report_id');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    
        
        return view('dashboard.comments.index', [
            'page' => 'Comments',
            'active' => 'comments',
            'comments' => $comments
        ]);

        
    }

    public function show(Comment $comment)
    {
        $comment = Comment::where('id', $comment->id)->firstOrFail();

        return view('dashboard.comments.show', [
            'page' => 'Comment Show',
            'active' => 'comments',
            'comment' => $comment
        ]);
    }

    public function hide(Comment $comment)
    {
        //
    }
}
