<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaksi;


class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Data dummy untuk tabel transaksi
        $transaksi = [
            [
                'id_pasien' => 5,  // ID pasien dari tabel users (pastikan sudah ada ID >= 5)
                'bidan' => 2,  
                'janji_id' => 1,   
                'keterangan' => 'Anak sudah diimunisasi dengan baik',

            ],
            [
                'id_pasien' => 6,  // ID pasien dari tabel users
                'bidan' => 2,
                'janji_id' => 2,   
                'keterangan' => 'Asam urat tinggi (8)'      
            ],
            [
                'id_pasien' => 7,  // ID pasien
                'bidan' => 2,
                'janji_id' => 3,   
                'keterangan' => 'Pengecekan sdh dilakukan dan asam urat normal'      
      
            ],
            [
                'id_pasien' => 5,  // ID pasien
                'bidan' => 2,
                'keterangan' => 'Pengecekan sdh dilakukan dan asam urat normal'      
      
            ],
        ];

        foreach ($transaksi as $key => $value) {
            Transaksi::create($value);
        }
    }
}