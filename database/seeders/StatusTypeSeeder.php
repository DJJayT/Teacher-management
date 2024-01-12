<?php

namespace Database\Seeders;

use App\Models\StatusType;
use Illuminate\Database\Seeder;

class StatusTypeSeeder extends Seeder
{
    public function run(): void{

        $statusTypes = [];

        $statusTypes[] = [
            'id' => 1,
            'name' => 'Beamter auf Widerruf',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $statusTypes[] = [
            'id' => 2,
            'name' => 'Beamter auf Probe',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $statusTypes[] = [
            'id' => 3,
            'name' => 'Beamter auf Lebenzeit',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $statusTypes[] = [
            'id' => 4,
            'name' => 'Beschäftigungsverhältnis unbefristet',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $statusTypes[] = [
            'id' => 5,
            'name' => 'BV befristet',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $statusTypes[] = [
            'id' => 6,
            'name' => 'Religionspädagoge im Kirchendienst',
            'created_at' => now(),
            'updated_at' => now()
        ];

        StatusType::insert($statusTypes);
    }
}
