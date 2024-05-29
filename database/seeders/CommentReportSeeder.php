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
        for($i = 0; $i < 10; $i++) {
            CommentReport::create([
                'comment_id' => rand(1, 100),
                'report_id' => rand(1, 14),
            ]);
        }
    }
}
