<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Report;
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
            'posts' => Post::with('category')->whereNull('report_id')->latest()->paginate(10),
            'reports' => Report::all()
        ]);
    }

    public function show(Post $post)
    {
        $post = Post::where('slug', $post->slug)->firstOrFail();
        
        if($post->report_id !== NULL){
            return abort(404);
        }
        return view('dashboard.posts.show', [
            'page'=> $post->title,
            'active' => 'admin-posts',
            'post'=> $post,
            'comments' => $post->comments()->orderBy('created_at', 'desc')->get(),
            'reports' => Report::all()
        ]);
    }

    public function hide(Request $request)
    {
        
        $post_id = $request->input('post_id');
        $report_id = $request->input('report_id');
        
        Post::where('id', $post_id)->update(['report_id' => $report_id]);
        return redirect()->back()->with('success', 'Post hidden successfully.');
        
    }
}
