<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'log_transaksi'; // Nama tabel
    public $timestamps = false;

    protected $fillable = [
        'id_pasien',
        'pasien',
        'bidan',
        'layanan',
        'tanggal',
        'biaya',
        'waktu_log',
    ];
}
