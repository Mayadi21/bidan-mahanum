<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        
        $posts = Post::where('status', 'published')
                ->whereNull('posts.report_id')
                ->whereHas('user', function ($query) {
                    $query->whereNull('report_id');
                })
                ->get()
        ;

        return view('blog.posts', [
            'page' => 'All Posts',
            'title' => 'All Posts',
            'posts' => $posts    
        ]);
    }

    public function show(Post $post)
    {
        if($post->status !== 'published' || $post->report_id) {
            abort(404);
        }

        $view_count = $post->view + 1;
        $post->update([
            'view' => $view_count
        ]);

        $comments = $post->comments()
                ->whereNull('comments.report_id')
                ->whereHas('user', function ($query) {
                    $query->whereNull('report_id');
                })
                ->orderBy('created_at', 'desc')
                ->get();

        return view('blog.post', [
            'page' => $post->title,
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function user(User $user)
    {
        return view('blog.user', [
            'page' => $user->name,
            'title' => $user->name,
            'user' => $user,
            'posts' => $user->posts()->where('status', 'published')->get()
        ]);
    }

    public function report(Post $post)
    {
        //
    }
}
