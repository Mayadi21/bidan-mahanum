<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penggajian;


class PenggajianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penggajian = [
            [
                'id_bidan' => 2,  // ID bidan dari tabel users (pastikan sudah ada ID >= 5)
                'gaji_pokok' => 3000000,     
                'bonus' => 500000,            // Bonus untuk bidan
                'tanggal_gajian' => '2024-11-30', // Tanggal gajian
                'status' => '0',              // Status (0: belum dibayar)
            ],
            [
                'id_bidan' => 3,  // ID bidan dari tabel users
                'gaji_pokok' => 2700000,     
                'bonus' => 400000,            // Bonus untuk bidan
                'tanggal_gajian' => '2024-11-30', // Tanggal gajian
                'status' => '0',              // Status (0: belum dibayar)
            ],
            [
                'id_bidan' => 4,  // ID bidan dari tabel users
                'gaji_pokok' => 2800000,     
                'bonus' => 450000,            // Bonus untuk bidan
                'tanggal_gajian' => '2024-11-30', // Tanggal gajian
                'status' => '1',              // Status (1: sudah dibayar)
            ],
        ];

        foreach ($penggajian as $key) {
            Penggajian::create($key);
        }
    }
}
