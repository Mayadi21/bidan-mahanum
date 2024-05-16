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
            'active' => 'admin-posts'
        ]);
    }

    public function show(Post $post)
    {
        return view('dashboard.posts.index', [
            'page' => $post->title,
            'active' => 'admin-posts'
        ]);
    }
}
