<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function scopeHasNotHiddenPost($query)
    {
        return $query->whereHas('post', function ($query) {
            $query->whereNull('report_id');
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->whereHas('post', function($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })
                ->orWhereHas('report', function($query) use ($search) {
                    $query->where('report_name', 'like', '%' . $search . '%');
                });
        });
    }
}
