<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentReport;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'body' => $request->body,
        ]);
    
        return back()->with('sukses', 'Komentar berhasil ditambahkan.');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return abort(403);
        }

        $comment->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }

    public function report(Request $request, Comment $comment)
    {
        $request->validate([
            'comment_id' => 'required|exists:comments,id',
            'report_id' => 'required|exists:reports,id'
        ]);

        $report = new CommentReport();
        $report->comment_id = $comment->id;
        $report->report_id = $request->report_id;
        $report->save();

        return back()->with('report', 'Comment has been reported.');
    }
}

