<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Comment;

class AdminCommentsController extends Controller
{
    public function index()
    {
        return view('dashboard.comments.index', [
            'page' => 'All Comments',
            'active' => 'admin-comments',
            'comments' => Comment::with('post')->whereNull('report_id')->latest()->paginate(10),
            'reports' => Report::all()
        ]);
    }

    public function show(Comment $comment)
    {
        $comment = Comment::where('id', $comment->id)->firstOrFail();

        if ($comment->report_id !== null) {
            return abort(404);
        }

        return view('dashboard.comments.show', [
            'page' => 'Comment Details',
            'active' => 'admin-comments',
            'comment' => $comment,
            'reports' => Report::all()
        ]);
    }

    public function hide(Request $request)
    {
        $comment_id = $request->input('comment_id');
        $report_id = $request->input('report_id');

        Comment::where('id', $comment_id)->update(['report_id' => $report_id]);
        return redirect()->back()->with('success', 'Comment hidden successfully.');
    }
}
