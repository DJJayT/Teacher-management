<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'abbreviation' => $this->faker->randomLetter() . $this->faker->randomLetter() . $this->faker->randomLetter(),
            'gender_id' => $this->faker->numberBetween(1, 3),
            'entry' => Carbon::now(),
            'exit' => Carbon::now(),
            'salary_grade_id' => $this->faker->numberBetween(1,19),
            'status_since' => Carbon::now(),
            'last_assessment_at' => Carbon::now(),
            'last_assessment_type_id' => $this->faker->numberBetween(1,3),
            'assessment_obstacle_id' => null,
            'assessment_obstacle_ends_at' => null,
            'expected_assessment_deadline' => Carbon::now()->addDays($this->faker->numberBetween(1, 365)),
            'fixed_assessment_deadline' => null,
            'next_assessment_type_id' => $this->faker->numberBetween(1,3),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'job_title_id' => $this->faker->numberBetween(1, 7),
            'status_type_id' => $this->faker->numberBetween(1, 6),
        ];
    }
}
