<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommentReport extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'comment_id', 'reason'];
    
    public $timestamps = false;
    
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static function store(Request $request, Comment $comment)
    {
        $request->validate([
            'report_id' => 'required|exists:reports,id',
        ]);

        CommentReport::create([
            'comment_id' => $comment->id,
            'report_id' => $request->report_id,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil dilaporkan.');
    }
}
