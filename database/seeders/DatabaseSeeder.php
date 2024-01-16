<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AssessmentObstacleSeeder::class,
            AssessmentTypeSeeder::class,
            StatusTypeSeeder::class,
            SalaryGradeSeeder::class,
            JobTitleSeeder::class,
            GenderSeeder::class,
            ProviderSeeder::class,
            AreaSeeder::class,
            SickTimeReasonSeeder::class,
            ExemtionOffDutyReasonSeeder::class,
            UserSeeder::class,
        ]);
    }
}
