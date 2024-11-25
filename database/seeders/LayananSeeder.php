<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Data layanan yang akan di-insert
        $layanan = [
            [
                'jenis_layanan' => 'Periksa Diabetes',
                'deskripsi' => 'Pemeriksaan kesehatan umum.',
                'harga' => 50000,
                'besar_bonus' => 5000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Periksa Asam Urat',
                'deskripsi' => 'Pemeriksaan untuk ibu hamil.',
                'harga' => 50000,
                'besar_bonus' => 5000,
                'status' => 'aktif',
            ],
            [
                'jenis_layanan' => 'Imunisasi',
                'deskripsi' => 'Imunisasi anak-anak dan dewasa.',
                'harga' => 100000,
                'besar_bonus' => 5000,
                'status' => 'aktif',
            ],

            [
                'jenis_layanan' => 'Periksa Kolesterol',
                'deskripsi' => 'Pemeriksaan kadar kolesterol dalam darah.',
                'harga' => 60000,
                'besar_bonus' => 6000,
            ],
            [
                'jenis_layanan' => 'Cek Kesehatan Jantung',
                'deskripsi' => 'Pemeriksaan untuk mendeteksi masalah jantung.',
                'harga' => 120000,
                'besar_bonus' => 7000,
            ],
            [
                'jenis_layanan' => 'Berobat',
                'deskripsi' => 'Pemeriksaan untuk mendeteksi kesehatan',
                'harga' => 50000,
                'besar_bonus' => 5000,
            ],
            [
                'jenis_layanan' => 'Sunat Laser Dewasa',
                'deskripsi' => 'Sunat menggunakan teknologi laser yang canggih bagi orang dewasa',
                'harga' => 400000,
                'besar_bonus' => 40000,
                'status' => 'tidak aktif'
            ],
        ];

        // Insert data layanan ke tabel menggunakan Eloquent
        foreach ($layanan as $data) {
            Layanan::create($data);
        }

    }
}


