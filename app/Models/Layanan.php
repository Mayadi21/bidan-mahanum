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
        'jenis_layanan',
        'deskripsi',
        'harga',
        'gambar',
        'besar_bonus',
        'status'
    ];

    public function promo()
    {
        return $this->hasMany(Promo::class, 'layanan_id');
    }
    
    // Scope untuk status aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif'); // Mengambil layanan dengan status 'aktif'
    }
    // Relasi dengan model JanjiTemu
    public function janjiTemu()
    {
        return $this->hasMany(JanjiTemu::class, 'layanan_id');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'layanan_id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'layanan_id');
    }

}