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
    protected $guarded = ['id'];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pasien'); // Ganti user_id menjadi id_pasien
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class, 'promo_id'); 
    }

    public function pasienTidakTerdaftar()
    {
        return $this->belongsTo(PasienTidakTerdaftar::class, 'pasien_tidak_terdaftar_id'); 
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'janji_id');
    }

    public function scopeDisetujui($query)
    {
        return $query->where('status', 'disetujui'); 
    }    

    public function scopeMenungguKonfirmasi($query)
    {
        return $query->where('status', 'menunggu konfirmasi'); 
    }    

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai'); 
    }    

    public function scopeDitolak($query)
    {
        return $query->where('status', 'ditolak'); 
    }    

    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('keluhan', 'like', '%' . $search . '%')
                ->orWhere('keterangan', 'like', '%' . $search . '%');
        });
    }
}
