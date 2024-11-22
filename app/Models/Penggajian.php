<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    protected $table = 'penggajian'; // Nama tabel
    public $timestamps = false; // Tidak menggunakan kolom created_at dan updated_at secara otomatis

    protected $fillable = [
        'id_bidan',
        'gaji_pokok',
        'bonus',
        'tanggal_gajian',
        'status',
    ];
}