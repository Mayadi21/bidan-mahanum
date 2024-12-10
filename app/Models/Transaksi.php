<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi'; // Nama tabel
    public $timestamps = false;
    protected $guarded = ['id'];

    public function pasienTidakTerdaftar()
    {
        return $this->belongsTo(PasienTidakTerdaftar::class, 'id_pasien');
    }


    // Relasi ke model User sebagai id_pasien
    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }


    public function janjiTemu()
    {
        return $this->belongsTo(JanjiTemu::class, 'janji_id');
    }

    // Relasi ke model User sebagai bidan
    public function bidanUser()
    {
        return $this->belongsTo(User::class, 'bidan');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }

}
