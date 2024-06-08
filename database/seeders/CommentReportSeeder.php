<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CommentReport;

class CommentReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reportIds = [5, 9, 13];
        $commentIds = [];

        for($i = 1; $i < 500; $i+=50) {
            $commentIds[] = $i;
        }

        for($i = 0; $i < 20; $i++) {
            CommentReport::create([
                'comment_id' => $commentIds[array_rand($commentIds)],
                'report_id' => $reportIds[array_rand($reportIds)],
            ]);
        }
    }
}
