<?php

namespace Database\Seeders;

use App\Models\OffDutyReason;
use Illuminate\Database\Seeder;

class OffDutyReasonSeeder extends Seeder
{
    public function run(): void
    {
        $offDutyDayReasons = [];

        $offDutyDayReasons[] = [
            'id' => 1,
            'reason' => 'Arztbesuch',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $offDutyDayReasons[] = [
            'id' => 2,
            'reason' => 'Umzug',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $offDutyDayReasons[] = [
            'id' => 3,
            'reason' => 'Geburt',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $offDutyDayReasons[] = [
            'id' => 4,
            'reason' => 'Todesfall',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $offDutyDayReasons[] = [
            'id' => 5,
            'reason' => 'Erkrankung eines Kindes',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $offDutyDayReasons[] = [
            'id' => 6,
            'reason' => 'Pflegeorganisation',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $offDutyDayReasons[] = [
            'id' => 7,
            'reason' => 'Fortbildung',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $offDutyDayReasons[] = [
            'id' => 8,
            'reason' => 'Sonstiges',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $offDutyDayReasons[] = [
            'id' => 9,
            'reason' => 'Dienstjubiläum',
            'created_at' => now(),
            'updated_at' => now()
        ];

        OffDutyReason::insert($offDutyDayReasons);
    }
}
