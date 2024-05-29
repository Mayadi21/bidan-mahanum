<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['report_name', 'report_description'];

    public $timestamps = false;

    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'reported_comment_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function show(Post $post)
{
    if ($post->status !== 'published' || $post->report_id) {
        abort(404);
    }

    $view_count = $post->view + 1;
    $post->update(['view' => $view_count]);

    $comments = $post->comments()
        ->whereNull('report_id')
        ->whereHas('user', function ($query) {
            $query->whereNull('report_id');
        })
        ->orderBy('created_at', 'desc')
        ->get();
    }
}
