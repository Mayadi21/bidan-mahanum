<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function commentReport()
    {
        return $this->hasMany(CommentReport::class);
    }

    public function scopeHidden($query)
    {
        return $query->whereNotNull('report_id');
    }
  
    public function scopeNotHidden($query)
    {
        return $query->whereNull('report_id');
    }

    public function scopeHasThisUserPost($query)
    {
        return $query->whereHas('post', function ($query){
            $query->user(auth()->user()->id);
        });
    }

    public function scopeHasNotBannedUser($query)
    {
        return $query->whereHas('user', function ($query) {
            $query->whereNull('report_id');
        });
    }

    public function scopeHasNotHiddenPost($query)
    {
        return $query->whereHas('post', function ($query) {
            $query->whereNull('report_id');
        });
    }

    public function scopeHasPublishedPost($query)
    {
        return $query->whereHas('post', function ($query) {
            $query->where('status', 'published');
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('body', 'like', '%' . $search . '%')
                ->orWhereHas('post', function($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })
                ->orWhereHas('report', function($query) use ($search) {
                    $query->where('report_name', 'like', '%' . $search . '%');
                });
        });
    }

    public function scopeFilteredSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('body', 'like', '%' . $search . '%')
                ->orWhereHas('post', function($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })
                ->orWhereHas('user', function($query) use ($search) {
                    $query->where('username', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
            });
        })
        ->whereNull('report_id')
        ->whereHas('user', function($query) {
            $query->whereNull('report_id');
        });
    }
}
