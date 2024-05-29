<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')
        ->where('posts.user_id', auth()->user()->id)
        ->whereNull('report_id')->get();

        $bannedPosts = Post::where('posts.user_id', auth()->user()->id)
        ->whereNotNull('report_id');

        return view('dashboard.index', [
            'page' => auth()->user()->name,
            'active' => 'dashboard',
            'posts' => $posts,
            'banned' => $bannedPosts
        ]);
    }
}
