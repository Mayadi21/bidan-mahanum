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
        $reports = CommentReport::with('comment')->hasNotHiddenPost();

        if (request('search')) {
            $reports->search(request('search'));
        }

        return view('dashboard.admin-report', [
            'page' => 'Comment Reports',
            'active' => 'admin-comment-reports',
            'reports' => $reports->paginate(10),
        ]);
    }

    public function show(Comment $comment) {// Mengambil comment daripada post
        return view('dashboard.comments.show', [
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

    public function deleteReports(Request $request)
    {
        $comment = Comment::findOrFail($request->input('comment_id'));
        $reportId = $request->input('report_id');
        
        CommentReport::where('comment_id', $comment->id)->where('report_id', $reportId)->delete();
        
        return back()->with('success', 'Comment report has been deleted.');
    }
}

