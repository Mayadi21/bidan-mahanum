<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rujukan;


class RujukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rujukan = [
            [
                'id_pasien' => 5, // ID pasien minimal 5
                'tanggal_rujukan' => '2024-11-28',
                'tujuan_rujukan' => 'RSUD Kota Medan',
                'keterangan' => 'Pasien memerlukan penanganan lebih lanjut untuk penyakit kronis.',
            ],
            [
                'id_pasien' => 6,
                'tanggal_rujukan' => '2024-11-29',
                'tujuan_rujukan' => 'RSUP Haji Adam Malik',
                'keterangan' => 'Rujukan untuk konsultasi spesialis bedah.',
            ],
            [
                'id_pasien' => 7,
                'tanggal_rujukan' => '2024-11-30',
                'tujuan_rujukan' => 'Klinik Spesialis Anak',
                'keterangan' => null, // Tidak ada keterangan
            ],
        ];

        foreach ($rujukan as $key => $value) {
            Rujukan::create($value);
        }

    }
}
