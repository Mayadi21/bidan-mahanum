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
        'keluhan',
        'waktu_janji',
        'status',
        'keterangan'
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pasien'); // Ganti user_id menjadi id_pasien
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
