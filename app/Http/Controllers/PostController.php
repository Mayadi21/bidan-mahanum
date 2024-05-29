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
        $posts = Post::where('status', 'published')
            ->whereNull('report_id')
            ->whereHas('user', function ($query) {
                $query->whereNull('report_id');
            })
            ->get();

        return view('blog.posts', [
            'page' => 'All Posts',
            'title' => 'All Posts',
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        if ($post->status !== 'published' || $post->report_id) {
            abort(404);
        }

        $view_count = $post->view + 1;
        $post->update([
            'view' => $view_count
        ]);

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
            'reports' => $reports
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

    public function storeReport(Request $request, Post $post)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'report_id' => 'required|exists:reports,id'
        ]);

        $report = new PostReport();
        $report->post_id = $post->id;
        $report->report_id = $request->report_id;
        $report->save();

        return redirect()->route('post.show', $post->slug)->with('success', 'Post telah dilaporkan.');
    }

    public function report(Request $request, Comment $comment)
    {
        $request->validate([
            'comment_id' => 'required|exists:comment,id',
            'report_id' => 'required|exists:reports,id'
        ]);

        $report = new CommentReport();
        $report->comment_id = $comment->id;
        $report->report_id = $request->report_id;
        $report->save();

        return redirect()->route('post.show', $post->slug)->with('success', 'Post telah dilaporkan.');
    }
}
