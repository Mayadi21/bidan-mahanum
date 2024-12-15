<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $table = 'promo';
    public $timestamps = false;
    protected $guarded = ['id'];


    public function janjiTemu()
    {
        return $this->hasMany(JanjiTemu::class, 'promo_id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id'); // Mengarah ke kolom 'id' di tabel 'layanan'
    }

    public function detailPromo()
    {
        return $this->hasMany(DetailPromo::class, 'promo_id');
    }

}