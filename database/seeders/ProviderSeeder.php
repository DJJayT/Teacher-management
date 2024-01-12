<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    public function run(): void
    {
        $providers = [];

        $providers[] = [
            'id' => 1,
            'name' => 'Oberbayern',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 2,
            'name' => 'Niederbayern',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 3,
            'name' => 'Oberfranken',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 4,
            'name' => 'Mittelfranken',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 5,
            'name' => 'Unterfranken',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 6,
            'name' => 'Oberpfalz',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 7,
            'name' => 'Schwaben',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 8,
            'name' => 'ALP Dillingen',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 9,
            'name' => 'ISB München',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 10,
            'name' => 'Staatliches Schulamt',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 11,
            'name' => 'Sonstige',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 12,
            'name' => 'LASPO',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 13,
            'name' => 'Erasmus+',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 14,
            'name' => 'Berufsschule Lichtenfels',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 15,
            'name' => 'Staatsinstitut Ansbach',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $providers[] = [
            'id' => 16,
            'name' => 'Institut für Lehrerfortbildung im Gars im Inn',
            'created_at' => now(),
            'updated_at' => now()
        ];

        Provider::insert($providers);
    }
}
