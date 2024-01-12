<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        $genders = [];

        $genders[] = [
            'id' => 1,
            'name' => 'Männlich',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $genders[] = [
            'id' => 2,
            'name' => 'Weiblich',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $genders[] = [
            'id' => 3,
            'name' => 'Divers',
            'created_at' => now(),
            'updated_at' => now()
        ];

        Gender::insert($genders);
    }
}
