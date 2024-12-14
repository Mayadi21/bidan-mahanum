<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalJanjiTemu extends Model
{
    use HasFactory;
        protected $table = 'jadwal_janji_temu';
        public $timestamps = false;
        protected $guarded = ['id'];

        public function janjiTemu()
    {
        return $this->hasMany(JanjiTemu::class, 'jadwal_id');
    }
}
