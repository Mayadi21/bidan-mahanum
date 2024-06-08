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
        $reportIds = [2, 7, 8];
        $postIds = [];

        for($i = 1; $i < 200; $i+=5) {
            $postIds[] = $i;
        }

        for($i = 0; $i < 20; $i++) {
            PostReport::create([
                'post_id' => $postIds[array_rand($postIds)],
                'report_id' => $reportIds[array_rand($reportIds)],
            ]);
        }
    }
}
