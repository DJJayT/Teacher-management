<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [];

        $areas[] = [
            'id' => 1,
            'description' => 'Wirtschaft',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 2,
            'description' => 'Metalltechnik',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 3,
            'description' => 'Informatik',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 4,
            'description' => 'Führungskräftequalifikation',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 5,
            'description' => 'Lehrerbildung',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 6,
            'description' => 'Digitalisierung/Medien',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 7,
            'description' => 'Erasmus+',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 8,
            'description' => 'Sport',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 9,
            'description' => 'QmbS',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 10,
            'description' => 'Betriebspraktikum',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 11,
            'description' => 'Deutsch',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 12,
            'description' => 'Englisch',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 13,
            'description' => 'Politik und Gesellschaft',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 14,
            'description' => 'Berufsintegration',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 15,
            'description' => 'Evaluation',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 16,
            'description' => 'Personalrat',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 17,
            'description' => 'Religion',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 18,
            'description' => 'Sonstiges',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $areas[] = [
            'id' => 19,
            'description' => 'Erste Hilfe in Bildungseinrichtungen',
            'created_at' => now(),
            'updated_at' => now()
        ];
        Area::insert($areas);
    }
}
