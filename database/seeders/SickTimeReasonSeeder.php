<?php

namespace Database\Seeders;

use App\Models\SickTimeReason;
use Illuminate\Database\Seeder;

class SickTimeReasonSeeder extends Seeder
{
    public function run(): void
    {
        $sickTimeReasons = [];

        $sickTimeReasons[] = [
            'id' => 1,
            'reason' => 'Erkrankung',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $sickTimeReasons[] = [
            'id' => 2,
            'reason' => 'Wiedereingliederung',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $sickTimeReasons[] = [
            'id' => 3,
            'reason' => 'Rehabilitation',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $sickTimeReasons[] = [
            'id' => 4,
            'reason' => 'Beschäftigungsverbot',
            'created_at' => now(),
            'updated_at' => now()
        ];

        SickTimeReason::insert($sickTimeReasons);
    }
}
