<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienTidakTerdaftar extends Model
{
    use HasFactory;
    protected $table = 'pasien_tidak_terdaftar';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function janjiTemu()
    {
        return $this->hasMany(JanjiTemu::class, 'pasien_tidak_terdaftar_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'pasien_tidak_terdaftar_id');
    }
}


