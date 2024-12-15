<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPromo extends Model
{
    use HasFactory;
    protected $table = 'detail_promo';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function janjiTemu()
    {
        return $this->hasMany(JanjiTemu::class, 'jadwal_promo_id');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'promo_id'); 
    }
}
