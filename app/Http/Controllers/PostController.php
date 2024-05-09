<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        return view('blog.posts', [
            'page' => 'All Posts',
            'title' => 'All Posts',
            'posts' => Post::where('status', 'published')->get()
        ]);
    }

    public function show(Post $post)
    {
        $view_count = $post->view + 1;
        $post->update([
            'view' => $view_count
        ]);

        return view('blog.post', [
            'page' => $post->title,
            'post' => $post,
            'comments' => $post->comments()->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function user(User $user)
    {
        return view('blog.user', [
            'page' => $user->name,
            'title' => $user->name,
            'username' => $user->username,
            'name' => $user->name,
            'posts' => $user->posts()->where('status', 'published')->get()
        ]);
    }
}
