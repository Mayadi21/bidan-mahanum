<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'log';

    // Disable timestamps since the table does not have created_at or updated_at
    public $timestamps = false;

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'modifier_id',
        'table_name',
        'log_target',
        'log_action',
        'old_value',
        'new_value',
        'log_time',
    ];

    // Optionally, you can add casting for JSON fields if needed
    // protected $casts = [
    //     'old_value' => 'string',
    //     'new_value' => 'string',
    // ];
}
