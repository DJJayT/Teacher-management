<?php

namespace Database\Seeders;

use App\Models\ExemptionOffDutyReason;
use Illuminate\Database\Seeder;

class ExemtionOffDutyReasonSeeder extends Seeder
{
    public function run(): void
    {
        $exemtionOffDutyReasons = [];

        $exemtionOffDutyReasons[] = [
            'id' => 1,
            'reason' => 'Arztbesuch',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $exemtionOffDutyReasons[] = [
            'id' => 2,
            'reason' => 'Umzug',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $exemtionOffDutyReasons[] = [
            'id' => 3,
            'reason' => 'Geburt',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $exemtionOffDutyReasons[] = [
            'id' => 4,
            'reason' => 'Todesfall',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $exemtionOffDutyReasons[] = [
            'id' => 5,
            'reason' => 'Erkrankung eines Kindes',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $exemtionOffDutyReasons[] = [
            'id' => 6,
            'reason' => 'Pflegeorganisation',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $exemtionOffDutyReasons[] = [
            'id' => 7,
            'reason' => 'Fortbildung',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $exemtionOffDutyReasons[] = [
            'id' => 8,
            'reason' => 'Sonstiges',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $exemtionOffDutyReasons[] = [
            'id' => 9,
            'reason' => 'Dienstjubiläum',
            'created_at' => now(),
            'updated_at' => now()
        ];

        ExemptionOffDutyReason::insert($exemtionOffDutyReasons);
    }
}
