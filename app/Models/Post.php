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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function incrementViews()
    {
        $this->timestamps = false; // Nonaktifkan timestamps
        $this->increment('view'); // Perbarui views
        $this->timestamps = true; // Aktifkan kembali timestamps
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
