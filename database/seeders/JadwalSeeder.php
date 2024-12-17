<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\JadwalJanjiTemu;
use Illuminate\Support\Facades\DB;



class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
        //     ['waktu_mulai' => Carbon::create(2024, 12, 16, 9, 0, 0), 'waktu_selesai' => Carbon::create(2024, 12, 16, 12, 0, 0), 'kuota' => 9],
        //     ['waktu_mulai' => Carbon::create(2024, 12, 16, 14, 0, 0), 'waktu_selesai' => Carbon::create(2024, 12, 16, 16, 0, 0), 'kuota' => 5],
            // ['waktu_mulai' => Carbon::create(2024, 12, 17, 9, 0, 0), 'waktu_selesai' => Carbon::create(2024, 12, 17, 12, 0, 0), 'kuota' => 9],
            // ['waktu_mulai' => Carbon::create(2024, 12, 17, 14, 0, 0), 'waktu_selesai' => Carbon::create(2024, 12, 17, 16, 0, 0), 'kuota' => 5],
            ['waktu_mulai' => Carbon::create(2024, 12, 18, 9, 0, 0), 'waktu_selesai' => Carbon::create(2024, 12, 18, 12, 0, 0), 'kuota' => 9],
            ['waktu_mulai' => Carbon::create(2024, 12, 18, 14, 0, 0), 'waktu_selesai' => Carbon::create(2024, 12, 18, 16, 0, 0), 'kuota' => 5],
            ['waktu_mulai' => Carbon::create(2024, 12, 19, 9, 0, 0), 'waktu_selesai' => Carbon::create(2024, 12, 19, 12, 0, 0), 'kuota' => 9],
            ['waktu_mulai' => Carbon::create(2024, 12, 19, 14, 0, 0), 'waktu_selesai' => Carbon::create(2024, 12, 19, 16, 0, 0), 'kuota' => 5],
            ['waktu_mulai' => Carbon::create(2024, 12, 20, 9, 0, 0), 'waktu_selesai' => Carbon::create(2024, 12, 20, 12, 0, 0), 'kuota' => 9],
            ['waktu_mulai' => Carbon::create(2024, 12, 20, 14, 0, 0), 'waktu_selesai' => Carbon::create(2024, 12, 20, 16, 0, 0), 'kuota' => 5],
        ];

        foreach ($schedules as $schedule) {
            DB::table('jadwal_janji_temu')->insert([
                'waktu_mulai' => $schedule['waktu_mulai'],
                'waktu_selesai' => $schedule['waktu_selesai'],
                'kuota' => $schedule['kuota'],
            ]);
        }
    }
}
