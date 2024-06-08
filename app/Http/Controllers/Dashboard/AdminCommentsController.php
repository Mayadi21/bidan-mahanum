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
        $comment = Comment::with('post')
                    ->notHidden()
                    ->hasNotBannedUser()
                    ->hasNotHiddenPost()
                    ->hasPublishedPost();

        if (request('search')) {
            $comment->filteredSearch(request('search'));
        }

        return view('dashboard.comments.index', [
            'page' => 'All Comments',
            'active' => 'admin-comments',
            'comments' => $comment->latest()->paginate(10),
            'reports' => Report::all()
        ]);
    }

    public function show(Comment $comment)
    {
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
