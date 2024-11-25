<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\LayananSeeder;
use Database\Seeders\JanjiTemuSeeder;
use Database\Seeders\RujukanSeeder;
use Database\Seeders\UlasanSeeder;
use Database\Seeders\GajiPokokSeeder;
use Database\Seeders\TransaksiSeeder;
use Database\Seeders\DetailTransaksiSeeder;
use Database\Seeders\PenggajianSeeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            LayananSeeder::class,
            JanjiTemuSeeder::class,
            RujukanSeeder::class,
            UlasanSeeder::class,
            TransaksiSeeder::class,
            DetailTransaksiSeeder::class,
            GajiPokokSeeder::class,
            PenggajianSeeder::class,
        ]);
    }
}
