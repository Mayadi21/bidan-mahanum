<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReport extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function scopeHasNotHiddenPost($query)
    {
        return $query->whereHas('comment.post', function ($query) {
            $query->whereNull('report_id');
        });
    }

    public function scopeHasPublishedPost($query)
    {
        return $query->whereHas('comment.post', function ($query) {
            $query->where('status', 'published');
        });
    }

    public function scopeHasNotBannedUser($query)
    {
        return $query->whereHas('comment.user', function ($query) {
            $query->whereNull('report_id');
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->whereHas('comment', function($query) use ($search) {
                    $query->where('body', 'like', '%' . $search . '%');
                })
                ->orWhereHas('report', function($query) use ($search) {
                    $query->where('report_name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('comment.post', function($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                });
        });
    }
}
