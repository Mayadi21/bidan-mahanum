<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JanjiTemu extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'janji_temu';
    public $timestamps = false;

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'id_pasien',
        'layanan_id',
        'keluhan',
        'waktu_janji',
        'status'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pasien'); // Ganti user_id menjadi id_pasien
    }

    // Relasi dengan model Layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
}
