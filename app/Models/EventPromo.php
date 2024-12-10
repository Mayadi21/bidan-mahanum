<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPromo extends Model
{
    use HasFactory;
    protected $table = 'event_promo';
    public $timestamps = false;
    protected $guarded = ['id'];


    public function janjiTemu()
    {
        return $this->hasMany(JanjiTemu::class, 'promo_id');
    }

    public function layanan()
    {
        return $this->belongsTo(User::class, 'layanan_id'); // Mengarah ke kolom 'id' di tabel 'layanan'
    }

}