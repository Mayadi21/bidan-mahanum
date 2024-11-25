<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ulasan;


    class UlasanSeeder extends Seeder
    {
        public function run()
        {
            $ulasan = [
                [
                    'id_pengguna' => 4, // ID pengguna yang memberikan ulasan
                    'layanan_id' => 1, // ID layanan (sesuaikan dengan ID layanan yang ada)
                    'ulasan' => 'Pelayanan yang sangat baik dan ramah, sangat membantu.',
                    'status' => 'aktif',
                ],
                [
                    'id_pengguna' => 8,
                    'layanan_id' => 1,
                    'ulasan' => 'Pemeriksaan diabetes dilakukan dengan profesionalisme tinggi.',
                    'status' => 'aktif',
                ],
                [
                    'id_pengguna' => 11,
                    'layanan_id' => 2,
                    'ulasan' => 'Proses pemeriksaan asam urat sangat cepat dan akurat.',
                    'status' => 'aktif',
                ],
                [
                    'id_pengguna' => 4,
                    'layanan_id' => 3,
                    'ulasan' => 'Layanan imunisasi sangat memuaskan, anak-anak merasa nyaman.',
                    'status' => 'aktif',
                ],
                [
                    'id_pengguna' => 5,
                    'layanan_id' => 3,
                    'ulasan' => 'Imunisasi yang aman dan staf sangat profesional.',
                    'status' => 'aktif',
                ],
                [
                    'id_pengguna' => 6,
                    'layanan_id' => 4,
                    'ulasan' => 'Proses pemeriksaan kolesterol berjalan lancar dan informatif.',
                    'status' => 'aktif',
                ],
                [
                    'id_pengguna' => 7,
                    'layanan_id' => 4,
                    'ulasan' => 'Sangat puas dengan hasil pemeriksaan kolesterol.',
                    'status' => 'aktif',
                ],
                [
                    'id_pengguna' => 8,
                    'layanan_id' => 5,
                    'ulasan' => 'Cek jantung yang sangat menyeluruh dan informatif.',
                    'status' => 'aktif',
                ],
                [
                    'id_pengguna' => 9,
                    'layanan_id' => 5,
                    'ulasan' => 'Pemeriksaan jantung yang sangat memadai dan membantu.',
                    'status' => 'aktif',
                ],
                [
                    'id_pengguna' => 10,
                    'layanan_id' => 6,
                    'ulasan' => 'Berobat di sini sangat baik, staf sangat membantu.',
                    'status' => 'aktif',
                ],
                [
                    'id_pengguna' => 11,
                    'layanan_id' => 6,
                    'ulasan' => 'Pelayanan kesehatan yang sangat ramah dan cepat.',
                    'status' => 'aktif',
                ],
                [
                    'id_pengguna' => 12,
                    'layanan_id' => 7,
                    'ulasan' => 'Sunat laser dewasa sangat efisien dan tanpa rasa sakit.',
                    'status' => 'tidak aktif',
                ],
                [
                    'id_pengguna' => 13,
                    'layanan_id' => 7,
                    'ulasan' => 'Proses sunat menggunakan teknologi laser sangat memuaskan.',
                    'status' => 'tidak aktif',
                ],
                [
                    'id_pengguna' => 11,
                    'layanan_id' => 1,
                    'ulasan' => 'Pemeriksaan diabetes sangat komprehensif.',
                    'status' => 'aktif',
                ],
                [
                    'id_pengguna' => 11,
                    'layanan_id' => 2,
                    'ulasan' => 'Pemeriksaan asam urat sangat akurat dan membantu.',
                    'status' => 'aktif',
                ],
            ];
            foreach ($ulasan as $key => $ulasan) {
                Ulasan::create($ulasan);
            }
    
        }
    }