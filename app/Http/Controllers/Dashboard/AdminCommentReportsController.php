<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommentReport;
use App\Models\Comment;

class AdminCommentReportsController extends Controller
{
    public function index()
    {
        $reports = CommentReport::with('comment')->paginate(10); // Ubah relasi 'post' menjadi 'comment'
        return view('dashboard.admin-report', [
            'page' => 'Comment Reports',
            'active' => 'admin-comment-reports',
            'reports' => $reports,
        ]);
    }

    public function show(Comment $comment) {// Mengambil comment daripada post
        return view('dashboard.admin-report', [
            'page' => 'Comment Reports',
            'active' => 'admin-comment-reports',
            'comment' => $comment,
        ]);
    }

    public function hide(Request $request)
    {
        $comment_id = $request->input('comment_id');
        $report_id = $request->input('report_id');
        
        Comment::where('id', $comment_id)->update(['report_id' => $report_id]); 
        CommentReport::where('comment_id', $comment_id)->delete(); 
        return redirect()->back()->with('success', 'Comment hidden successfully.'); 
    }

    public function deleteReports($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        
        
        CommentReport::where('comment_id', $comment->id)->delete();
        
        return redirect()->route('admin.comment-reports.index')->with('success', 'All reports for the comment have been deleted.');
    }
}

