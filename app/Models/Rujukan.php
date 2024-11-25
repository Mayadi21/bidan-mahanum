<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rujukan extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'rujukan';
    public $timestamps = false;
    
    protected $fillable = [
        'id_pasien', 'tanggal_rujukan', 'tujuan_rujukan', 'keterangan'
    ];

    /**
     * Relasi dengan model User (One-to-Many)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }
}