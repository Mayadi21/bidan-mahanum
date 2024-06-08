<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function post()
    {
        return $this->hasOne(Post::class);
    }

    public function comment()
    {
        return $this->hasOne(Comment::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('report_name', 'like', '%' . $search . '%')
            ->orWhere('report_description', 'like', '%' . $search . '%');
    }
}
