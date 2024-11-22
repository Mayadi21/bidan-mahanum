<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'layanan';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'besar_bonus',
    ];

    // Relasi dengan model JanjiTemu
    public function janjiTemus()
    {
        return $this->hasMany(JanjiTemu::class, 'layanan_id');
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'layanan_id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'layanan_id');
    }

}