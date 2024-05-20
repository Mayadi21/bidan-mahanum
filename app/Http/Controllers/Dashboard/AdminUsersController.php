<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUsersController extends Controller
{
    public function index()
    {
        return view('dashboard.admin-users.index', [
            'page' => 'Admin Users',
            'active' => 'admin-users',
        ]);
    }

    public function show(User $user)
    {
        return view('dashboard.admin-users.detail', [
            'page' => 'Admin Users',
            'active' => 'admin-users',
            'user' => $user,
            'hiddenPosts' => $user->posts()->whereNotNull('report_id')->get(),
            'hiddenComments' => $user->comments()->whereNotNull('report_id')->get(),
        ]);
    }

    public function ban()
    {
        //
    }

    public function hiddenPosts(User $user, Post $post)
    {
        return view('dashboard.posts.show', [
            'page' => $post->title,
            'active' => 'admin-users',
            'post' => $post,
            'comments' => $post->comments
        ]);
    }

    public function hiddenComments(User $user, Comment $comment)
    {
        return view('dashboard.comments.show', [
            'page' => 'Comment',
            'active' => 'admin-users',
            'comment' => $comment
        ]);
    }
}
