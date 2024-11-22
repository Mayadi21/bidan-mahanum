<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    // Menentukan kolom-kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'id_pengguna',
        'layanan_id',
        'ulasan',
        'tanggal_ulasan',
    ];

    // Relasi dengan model User (id_pengguna)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna'); // Mengarah ke kolom 'id' di tabel 'users'
    }

    // Relasi dengan model Layanan (layanan_id)
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
}