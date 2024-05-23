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
}
