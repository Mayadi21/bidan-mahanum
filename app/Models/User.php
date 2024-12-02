<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{use HasApiTokens, HasFactory, Notifiable, CanResetPassword;
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif'); // Memeriksa kolom status yang bernilai 'aktif'
    }    
    public function scopeBanned($query)
    {
        return $query->where('status', 'tidak aktif'); // Memeriksa kolom status yang bernilai 'aktif'
    }

        public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search) {
            $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('pekerjaan', 'like', '%' . $search . '%');
        });
    }


    // Relasi dengan model Rujukan (One-to-Many)
    public function rujukan()
    {
        return $this->hasMany(Rujukan::class, 'id_pasien');
    }

    // Relasi dengan model Ulasan
    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'id_pengguna');
    }

    // Relasi dengan model JanjiTemu
    public function janjiTemu()
    {
        return $this->hasMany(JanjiTemu::class, 'id_pasien');
    }

    // Tambahkan relasi untuk pasien
    public function transaksiSebagaiPasien()
    {
        return $this->hasMany(Transaksi::class, 'id_pasien');
    }

    // Tambahkan relasi untuk bidan
    public function transaksiSebagaiBidan()
    {
        return $this->hasMany(Transaksi::class, 'bidan');
    }

}

