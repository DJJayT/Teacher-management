<?php

namespace Database\Seeders;

use App\Models\AssessmentObstacle;
use Illuminate\Database\Seeder;

class AssessmentObstacleSeeder extends Seeder
{

    public function run(): void
    {
        $assessmentObstacles = [];

        $assessmentObstacles[] = [
            'id' => 1,
            'reason' => 'Probezeit',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $assessmentObstacles[] = [
            'id' => 2,
            'reason' => 'Elternzeit',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $assessmentObstacles[] = [
            'id' => 3,
            'reason' => 'Beurlaubung',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $assessmentObstacles[] = [
            'id' => 4,
            'reason' => 'Sabbatjahr',
            'created_at' => now(),
            'updated_at' => now()
        ];

        AssessmentObstacle::insert($assessmentObstacles);
    }
}
