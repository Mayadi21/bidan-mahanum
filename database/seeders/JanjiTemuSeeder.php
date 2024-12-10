<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JanjiTemu;


class JanjiTemuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $janjiTemu = [
            [
                'id_pasien' => 5,
                'keluhan' => 'Ingin imunisasi anak',
                'waktu_mulai' => '2024-11-22 09:00:00',
                'status' => 'disetujui'
            ],
            [
                'id_pasien' => 6,
                'keluhan' => 'Mau cek asam urat',
                'waktu_mulai' => '2024-12-22 14:00:00',
                'status' => 'disetujui'
            ],
            [
                'id_pasien' => 7, // ID pasien dari tabel users
                'keluhan' => 'Sakit kepala terus-menerus',
                'waktu_mulai' => '2024-12-27 10:00:00',
                'status' => 'disetujui'
            ],
        ];

        // Insert data janjitemu ke tabel menggunakan Eloquent
        foreach ($janjiTemu as $data) {
            JanjiTemu::create($data);
            }
    }
}
