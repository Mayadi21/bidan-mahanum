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
        })->paginate(10);

        return view('dashboard.comments.index', [
            'page' => 'Comments',
            'active' => 'comments',
            'comments' => $comments,
        ]);
    }

    public function show(Comment $comment)
    {
        return view('dashboard.comments.show', [
            'page' => 'Comment Show',
            'active' => 'comments',
        ]);
    }

    public function hide(Comment $comment)
    {
        //
    }
}
