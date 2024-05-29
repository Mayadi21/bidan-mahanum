<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PostReport;
use App\Models\Comment;
use App\Models\Post;


class AdminPostReportsController extends Controller
{
    public function index()
    {
        $reports = PostReport::with('post')->paginate(10);

        return view('dashboard.admin-report', [
            'page' => 'Post Reports',
            'active' => 'admin-post-reports',
            'reports' => $reports,
        ]);
    }

    public function show(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->get();
        // JANGAN DIGANTI VIEWNYA
        return view('dashboard.posts.show', [
            'page' => 'Post Reports',
            'active' => 'admin-post-reports',
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function hide(Request $request)
    {
        $post_id = $request->input('post_id');
        $report_id = $request->input('report_id');
        
        Post::where('id', $post_id)->update(['report_id' => $report_id]);
        PostReport::where('post_id', $post_id)->delete();
        return redirect()->back()->with('success', 'Post hidden successfully.');


    }

    public function deleteReports($postId)
    {
        $post = Post::findOrFail($postId);
        
        PostReport::where('post_id', $post->id)->delete();
        
        return redirect()->route('admin.post-reports.index')->with('success', 'All reports for the post have been deleted.');
    }
}