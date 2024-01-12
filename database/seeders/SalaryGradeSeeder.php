<?php

namespace Database\Seeders;

use App\Models\SalaryGrade;
use Illuminate\Database\Seeder;

class SalaryGradeSeeder extends Seeder
{

    public function run(): void
    {
        $salaryGrades = [];

        $salaryGrades[] = [
            'id' => 1,
            'name' => 'A8',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 2,
            'name' => 'A9',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 3,
            'name' => 'A10',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 4,
            'name' => 'A11',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 5,
            'name' => 'A12',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 6,
            'name' => 'A13',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 7,
            'name' => 'A14',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 8,
            'name' => 'A15',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 9,
            'name' => 'A16',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 10,
            'name' => 'E5',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 11,
            'name' => 'E6',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 12,
            'name' => 'E7',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 13,
            'name' => 'E8',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 14,
            'name' => 'E9',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 15,
            'name' => 'E10',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 16,
            'name' => 'E11',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 17,
            'name' => 'E12',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 18,
            'name' => 'E13',
            'created_at' => now(),
            'updated_at' => now()
        ];
        $salaryGrades[] = [
            'id' => 19,
            'name' => 'E14',
            'created_at' => now(),
            'updated_at' => now()
        ];

        SalaryGrade::insert($salaryGrades);
    }
}
