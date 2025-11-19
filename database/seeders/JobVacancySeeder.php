<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobVacancy;

class JobVacancySeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'UI UX Designer',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Bertanggung jawab dalam mendesain antarmuka aplikasi yang menarik dan user-friendly.',
                'location' => 'Lorem ipsum',
                'company' => 'PT Visual',
                'salary' => '5000000',
                'job_type' => 'Full-time',
            ],
            [
                'title' => 'Web Developer',
                'description' => 'Mengembangkan dan maintain website menggunakan teknologi modern seperti Laravel, React, dan Vue.js.',
                'location' => 'Lorem ipsum',
                'company' => 'PT Coders',
                'salary' => '7000000',
                'job_type' => 'Full-time',
            ],
            [
                'title' => 'Backend Engineer',
                'description' => 'Membangun dan mengoptimalkan sistem backend dengan fokus pada skalabilitas dan performa tinggi.',
                'location' => 'Sleman',
                'company' => 'PT BackendPro',
                'salary' => '8000000',
                'job_type' => 'Full-time',
            ],
            [
                'title' => 'Data Analyst',
                'description' => 'Menganalisis data bisnis untuk memberikan insight dan rekomendasi strategis kepada manajemen.',
                'location' => 'Bantul',
                'company' => 'PT Datawise',
                'salary' => '7500000',
                'job_type' => 'Full-time',
            ],
            [
                'title' => 'Mobile Developer',
                'description' => 'Mengembangkan aplikasi mobile untuk platform Android dan iOS menggunakan Flutter atau React Native.',
                'location' => 'Yogyakarta',
                'company' => 'PT MobileTech',
                'salary' => '8500000',
                'job_type' => 'Full-time',
            ],
            [
                'title' => 'DevOps Engineer',
                'description' => 'Mengelola infrastruktur cloud, CI/CD pipeline, dan monitoring sistem production.',
                'location' => 'Remote',
                'company' => 'PT CloudOps',
                'salary' => '9000000',
                'job_type' => 'Remote',
            ],
        ];

        foreach ($jobs as $job) {
            JobVacancy::create($job);
        }
    }
}
