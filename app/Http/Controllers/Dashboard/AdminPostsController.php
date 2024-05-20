<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPostsController extends Controller
{
    public function index()
    {
        return view('dashboard.posts.index', [
            'page' => 'All Posts',
            'active' => 'admin-posts',
            'posts' => Post::with('category')->latest()->paginate(10)
        ]);
    }

    public function show(Post $post)
    {
        $post = Post::where('slug', $post->slug)->firstOrFail();

        return view('dashboard.posts.show', [
            'page'=> $post->title,
            'active' => 'admin-posts',
            'post'=> $post,
            'comments' => $post->comments()->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function hide(Post $post)
    {
        //
    }
}
