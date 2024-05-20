<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $report_names = [
            'Inappropriate Content', 
            'Hate Speech', 
            'Copyright Violation', 
            'Spam', 
            'Phishing or Malware', 
            'Privacy Violation', 
            'Fraud or Illegal Activity', 
            'Defamation or Libel',
            'Impersonation',
            'Harassment or Bullying',
            'False Information',
            'Offensive Language',
            'Terrorism or Violence',
            'Self-Harm or Suicide'
        ];

        $report_descriptions = [
            'Content that is obscene, vulgar, or offensive.',
            'Speech that promotes hatred or discrimination against individuals or groups.',
            'Content that infringes on copyrights or intellectual property rights.',
            'Unwanted advertisements or repeated irrelevant posts.',
            'Links or content intended to deceive users or spread malware.',
            'Uploading personal information of others without consent.',
            'Posts containing fraudulent offers or encouraging illegal activities.',
            'Content that falsely damages the reputation of individuals or organizations.',
            'Pretending to be someone else or an organization to deceive.',
            'Actions that disturb or intimidate other users.',
            'Spreading false or misleading information.',
            'Use of harsh or insulting language.',
            'Content that supports or promotes terrorism or violence.',
            'Content encouraging or glorifying self-harm or suicide.'
        ];

        foreach ($report_names as $index => $name) {
            Report::create([
                'report_name' => $name,
                'report_description' => $report_descriptions[$index]
            ]);
        }
    }
}
