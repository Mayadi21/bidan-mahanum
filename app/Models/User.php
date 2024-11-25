<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{use HasApiTokens, HasFactory, Notifiable, CanResetPassword;
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'tanggal_lahir',
        'pekerjaan',
        'no_hp',
        'password',
        'status',
        'role'
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


//     use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array<int, string>
//      */
//     protected $guarded = ['id'];

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var array<int, string>
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     /**
//      * The attributes that should be cast.
//      *
//      * @var array<string, string>
//      */
//     protected $casts = [
//         'password' => 'hashed',
//     ];

//     public function comments()
//     {
//         return $this->hasMany(Comment::class);
//     }

//     public function posts()
//     {
//         return $this->hasMany(Post::class);
//     }

//     public function report()
//     {
//         return $this->belongsTo(Report::class);
//     }

//     public function scopeRole($query, $role)
//     {
//         return $query->where('role', $role);
//     }

//     public function maskedEmail()
//     {
//         $email = $this->email;
//         $atPosition = strpos($email, '@'); // Temukan posisi karakter '@'

//         if ($atPosition === false) {
//             return $email; // Jika tidak ditemukan '@', kembalikan email asli
//         }

//         $username = substr($email, 0, $atPosition); // Bagian sebelum '@'
//         $domain = substr($email, $atPosition); // Bagian setelah '@'
//         $usernameLength = strlen($username);

//         if ($usernameLength < 9) {
//             // Jika panjang username kurang dari 9 karakter
//             return str_repeat('*', $usernameLength) . $domain;
//         } else if ($usernameLength >= 9 && $usernameLength <= 15) {
//             // Jika panjang username antara 9 dan 15 karakter
//             $visibleChars = substr($username, 0, 2); // Ambil 2 digit pertama dari username
//             $hiddenChars = str_repeat('*', $usernameLength - 2); // Tutupi karakter sisanya dengan '*'
//             return $visibleChars . $hiddenChars . $domain;
//         } else {
//             // Jika panjang username lebih dari 15 karakter
//             $visibleChars = substr($username, 0, 2); // Ambil 2 digit pertama dari username
//             $hiddenChars = str_repeat('*', $usernameLength - 4); // Tutupi karakter tengah dengan '*'
//             $visibleChars .= $hiddenChars . substr($username, -2); // Tambahkan 2 digit terakhir dari username
//             return $visibleChars . $domain;
//         }
//     }



}

