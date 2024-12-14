<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JanjiTemu;
use Carbon\Carbon;

class JanjiTemuSeeder extends Seeder
{
    public function run(): void
    {
        $janjiTemu = [
            // Data yang sudah ada
            [
                'id_pasien' => 5,
                'keluhan' => 'Ingin imunisasi anak',
                'status' => 'disetujui',
                'jadwal_id' => 1,  // ID jadwal 2024-12-16 09:00:00
            ],
            [
                'id_pasien' => 6,
                'keluhan' => 'Mau cek asam urat',
                'status' => 'disetujui',
                'jadwal_id' => 2,  // ID jadwal 2024-12-16 14:00:00
            ],
            [
                'id_pasien' => 7, 
                'keluhan' => 'Sakit kepala terus-menerus',
                'status' => 'disetujui',
                'jadwal_id' => 3,  // ID jadwal 2024-12-17 09:00:00
            ],
            [
                'id_pasien' => 8,
                'keluhan' => 'Sakit pinggang',
                'status' => 'menunggu konfirmasi',
                'jadwal_id' => 4,  // ID jadwal 2024-12-17 14:00:00
            ],
            [
                'id_pasien' => 9,
                'keluhan' => 'Flu berat',
                'status' => 'menunggu konfirmasi',
                'jadwal_id' => 5,  // ID jadwal 2024-12-18 09:00:00
            ],
            [
                'id_pasien' => 10,
                'keluhan' => 'Cek gula darah',
                'status' => 'menunggu konfirmasi',
                'jadwal_id' => 6,  // ID jadwal 2024-12-18 14:00:00
            ],

            // 5 data tambahan untuk jadwal 2024-12-16
            [
                'id_pasien' => 11,
                'keluhan' => 'Cek kolesterol',
                'status' => 'menunggu konfirmasi',
                'jadwal_id' => 1,  // ID jadwal 2024-12-16 09:00:00
            ],
            [
                'id_pasien' => 12,
                'keluhan' => 'Sakit tenggorokan',
                'status' => 'disetujui',
                'jadwal_id' => 1,  // ID jadwal 2024-12-16 09:00:00
            ],
            [
                'id_pasien' => 13,
                'keluhan' => 'Cek tekanan darah',
                'status' => 'menunggu konfirmasi',
                'jadwal_id' => 2,  // ID jadwal 2024-12-16 14:00:00
            ],
            [
                'id_pasien' => 4,
                'keluhan' => 'Pemeriksaan mata',
                'status' => 'disetujui',
                'jadwal_id' => 2,  // ID jadwal 2024-12-16 14:00:00
            ],

        ];

        // Insert data janji temu ke tabel menggunakan Eloquent
        foreach ($janjiTemu as $data) {
            JanjiTemu::create($data);
        }
    }
}