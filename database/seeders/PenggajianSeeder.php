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
            // [
            //     'id_bidan' => 2,  // ID bidan dari tabel users (pastikan sudah ada ID >= 5)
            //     'gaji_pokok' => 3000000,     
            //     'bonus' => 500000,            // Bonus untuk bidan
            //     'bulan_gaji' => 9, //bulan gaji
            //     'tahun_gaji' => 2024,
            //     'tanggal_penggajian' => '2024-09-25', // Tanggal gajian
            //     'status' => '1',              // Status (0: belum dibayar)
            // ],
            // [
            //     'id_bidan' => 3,  // ID bidan dari tabel users
            //     'gaji_pokok' => 2700000,     
            //     'bonus' => 400000,            // Bonus untuk bidan
            //     'bulan_gaji' => 9, //bulan gaji
            //     'tahun_gaji' => 2024,
            //     'tanggal_penggajian' => '2024-09-25', // Tanggal gajian
            //     'status' => '1',              // Status (0: belum dibayar)
            // ],
            // [
            //     'id_bidan' => 2,  // ID bidan dari tabel users (pastikan sudah ada ID >= 5)
            //     'gaji_pokok' => 3000000,     
            //     'bonus' => 600000,            // Bonus untuk bidan
            //     'bulan_gaji' => 10, //bulan gaji
            //     'tahun_gaji' => 2024,
            //     'tanggal_penggajian' => '2024-10-25', // Tanggal gajian
            //     'status' => '1',              // Status (0: belum dibayar)
            // ],
            // [
            //     'id_bidan' => 3,  // ID bidan dari tabel users (pastikan sudah ada ID >= 5)
            //     'gaji_pokok' => 2700000,     
            //     'bonus' => 500000,            // Bonus untuk bidan
            //     'tahun_gaji' => 2024,
            //     'bulan_gaji' => 10, //bulan gaji
            //     'tanggal_penggajian' => '2024-10-25', // Tanggal gajian
            //     'status' => '1',              // Status (0: belum dibayar)
            // ],
            [
                'id_bidan' => 2,  // ID bidan dari tabel users (pastikan sudah ada ID >= 5)
                'gaji_pokok' => 3000000,
                'bonus' => 650000,            // Bonus untuk bidan
                'tahun_gaji' => 2024,
                'bulan_gaji' => 11, //bulan gaji
                'tanggal_penggajian' => '2024-11-25', // Tanggal gajian
                'status' => '1',              // Status (0: belum dibayar)
            ],
            [
                'id_bidan' => 3,  // ID bidan dari tabel users (pastikan sudah ada ID >= 5)
                'gaji_pokok' => 2700000,     
                'bonus' => 530000,            // Bonus untuk bidan
                'bulan_gaji' => 11, //bulan gaji
                'tahun_gaji' => 2024,
                'tanggal_penggajian' => '2024-11-25', // Tanggal gajian
                'status' => '1',              // Status (0: belum dibayar)
            ]  ,      
            [
                'id_bidan' => 2,  // ID bidan dari tabel users (pastikan sudah ada ID >= 5)
                'gaji_pokok' => 3000000,
                'bonus' => 0,            // Bonus untuk bidan
                'tahun_gaji' => 2024,
                'bulan_gaji' => 12, //bulan gaji
                'status' => '0',              // Status (0: belum dibayar)
            ],
            [
                'id_bidan' => 3,  // ID bidan dari tabel users (pastikan sudah ada ID >= 5)
                'gaji_pokok' => 2700000,     
                'bonus' => 0,            // Bonus untuk bidan
                'bulan_gaji' => 12, //bulan gaji
                'tahun_gaji' => 2024,
                'status' => '0',              // Status (0: belum dibayar)
            ]
        ];

        foreach ($penggajian as $key) {
            Penggajian::create($key);
        }
    }
}
