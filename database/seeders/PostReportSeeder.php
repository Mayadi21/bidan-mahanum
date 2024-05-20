<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PostReport;

class PostReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 10; $i++) {
            PostReport::create([
                'post_id' => rand(1, 40),
                'report_id' => rand(1, 14),
            ]);
        }
    }
}
