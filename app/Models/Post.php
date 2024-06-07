<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function postReport()
    {
        return $this->hasMany(Report::class);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeUser($query, $user)
    {
        return $query->where('user_id', $user);
    }

    public function scopeHidden($query)
    {
        return $query->whereNotNull('report_id');
    }

    public function scopeNotHidden($query)
    {
        return $query->whereNull('report_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('category', function($query) use ($search) {
                    $query->where('category_name', 'like', '%' . $search . '%');
                });
        });
    }

    public function scopeFilteredSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('category', function($query) use ($search) {
                    $query->where('category_name', 'like', '%' . $search . '%');
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


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function incrementViews()
    {
        $this->timestamps = false;
        $this->increment('view');
        $this->timestamps = true;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
