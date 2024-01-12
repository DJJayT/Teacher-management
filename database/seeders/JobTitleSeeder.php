<?php

namespace Database\Seeders;

use App\Models\JobTitle;
use Illuminate\Database\Seeder;

class JobTitleSeeder extends Seeder
{
    public function run(): void
    {
        $jobTitles = [];

        $jobTitles[] = [
            'id' => 1,
            'name' => 'StR',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $jobTitles[] = [
            'id' => 2,
            'name' => 'OStR',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $jobTitles[] = [
            'id' => 3,
            'name' => 'StD',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $jobTitles[] = [
            'id' => 4,
            'name' => 'OStD',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $jobTitles[] = [
            'id' => 5,
            'name' => 'VL',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $jobTitles[] = [
            'id' => 6,
            'name' => 'FL',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $jobTitles[] = [
            'id' => 7,
            'name' => 'StRef',
            'created_at' => now(),
            'updated_at' => now()
        ];

        JobTitle::insert($jobTitles);
    }

}
