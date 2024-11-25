<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiPokok extends Model
{
    use HasFactory;

    protected $table = 'gaji_pokok'; // Nama tabel
    public $timestamps = false; // Tidak menggunakan created_at dan updated_at

    protected $fillable = [
        'id_bidan',
        'gaji_pokok',
    ];

    // Relasi dengan User (bidan)
    public function bidan()
    {
        return $this->belongsTo(User::class, 'id_bidan');
    }
}