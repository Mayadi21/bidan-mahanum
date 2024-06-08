<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use App\Models\PostReport;
use App\Models\Comment;
use App\Models\CommentReport;

class PostController extends Controller
{
    public function index()
    {    
        $title = 'All Posts';
        $posts = Post::status('published')
                ->notHidden()
                ->hasNotBannedUser()
                ->orderBy('updated_at', 'desc')
        ;

        if(request('search')) {
            $search = request('search');
            $posts = $posts->filteredSearch($search);
            $title = 'Search Result: ' . request('search');
        }

        return view('blog.posts', [
            'page' => 'All Posts',
            'title' => $title,
            'posts' => $posts->get(),
            'active' => 'posts'
        ]);
    }


    public function show(Post $post)
    {
        if($post->status !== 'published' || $post->report_id) {
            abort(404);
        }

        $post->incrementViews();

        $comments = $post->comments()
                ->whereNull('comments.report_id')
                ->whereHas('user', function ($query) {
                    $query->whereNull('report_id');
                })
                ->orderBy('created_at', 'desc')
                ->get();
        
        $comments = $post->comments()
            ->whereNull('report_id')
            ->whereHas('user', function ($query) {
                $query->whereNull('report_id');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $reports = Report::all();

        return view('blog.post', [
            'page' => $post->title,
            'post' => $post,
            'comments' => $comments,
            'active' => 'posts',
            'reports' => $reports
        ]);
    }

    public function user(User $user)
    {
        if($user->report_id) {
            abort(404);
        }

        return view('blog.user', [
            'page' => $user->name,
            'title' => $user->name,
            'user' => $user,
            'posts' => $user->posts()->where('status', 'published')->whereNull('posts.report_id')->get(),
            'active' => 'posts'
        ]);
    }

    public function report(Request $request, Post $post)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'report_id' => 'required|exists:reports,id'
        ]);

        $report = new PostReport();
        $report->post_id = $post->id;
        $report->report_id = $request->report_id;
        $report->save();

        return redirect()->route('post.show', $post->slug)->with('report', 'Post has been reported.');
    }

}
