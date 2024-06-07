<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Report;
use App\Models\CommentReport;


class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::hasThisUserPost()
                    ->notHidden()
                    ->hasNotBannedUser()
                    ->hasNotHiddenPost();

        if(request('search')) {
            $comments->search(request('search'));
        }
    
        return view('dashboard.comments.index', [
            'page' => 'Comments',
            'active' => 'comments',
            'comments' => $comments->orderBy('created_at', 'desc')->paginate(10),
            'reports' => Report::all()
        ]);

        
    }

    public function show(Comment $comment)
    {
        $comment = Comment::where('id', $comment->id)->firstOrFail();

        return view('dashboard.comments.show', [
            'page' => 'Comment Show',
            'active' => 'comments',
            'comment' => $comment
        ]);
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

        return back()->with('success', 'Comment has been reported.');
    }
}
