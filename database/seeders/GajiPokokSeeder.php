<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GajiPokok;


class GajiPokokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data dummy untuk tabel transaksi
        $gajipokok = [
            [
                'id_bidan' => 2,  // ID bidan dari tabel users (pastikan sudah ada ID >= 5)
                'gaji_pokok' => 3000000,      
            ],                    [
                'id_bidan' => 3,  // ID bidan dari tabel users (pastikan sudah ada ID >= 5)
                'gaji_pokok' => 2700000,      
            ],


        ];

        // Insert data gajipokok ke tabel menggunakan Eloquent
        foreach ($gajipokok as $data) {
        GajiPokok::create($data);
        }
    }
}
