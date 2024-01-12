<?php

namespace Database\Seeders;

use App\Models\AssessmentType;
use Illuminate\Database\Seeder;

class AssessmentTypeSeeder extends Seeder
{
    public function run():void{

        $assessmentTypes = [];

        $assessmentTypes[] =[
            'id' => 1,
            'name' => 'Einschätzung zur Probezeit',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $assessmentTypes[] =[
            'id' => 2,
            'name' => 'Probezeitbeurteilung',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $assessmentTypes[] =[
            'id' => 3,
            'name' => 'Dienstliche Beurteilung',
            'created_at' => now(),
            'updated_at' => now()
        ];

        AssessmentType::insert($assessmentTypes);
    }
}
