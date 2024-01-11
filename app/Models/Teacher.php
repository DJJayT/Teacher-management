<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Teacher extends Model
{
    protected $fillable = [
        'abbreviation',
        'gender_id',
        'entry',
        'exit',
        'job_title_id',
        'salary_grade_id',
        'status',
        'status_since',
        'last_assessment_at',
        'last_assessment_type_id',
        'assessment_obstacle_id',
        'assessment_obstacle_ends_at',
        'expected_assessment_deadline',
        'fixed_assessment_deadline',
        'next_assessment_type_id',
    ];

    protected $casts = [
        'entry' => 'date',
        'exit' => 'date',
        'status_since' => 'date',
        'last_assessment_at' => 'date',
        'assessment_obstacle_ends_at' => 'date',
        'expected_assessment_deadline' => 'date',
        'fixed_assessment_deadline' => 'date',
    ];

    public function gender(): HasOne
    {
        return $this->hasOne(Gender::class);
    }

    public function jobTitle(): HasOne
    {
        return $this->hasOne(JobTitle::class);
    }

    public function salaryGrade(): HasOne
    {
        return $this->hasOne(SalaryGrade::class);
    }

    public function status(): HasOne
    {
        return $this->hasOne(StatusType::class);
    }

    public function lastAssessment(): HasOne
    {
        return $this->hasOne(AssessmentType::class);
    }

    public function assessmentObstacle(): HasOne
    {
        return $this->hasOne(AssessmentObstacle::class);
    }

    public function nextAssessment(): HasOne
    {
        return $this->hasOne(AssessmentType::class);
    }

    public function trainings(): HasManyThrough
    {
        return $this->hasManyThrough(Training::class, TeacherTraining::class, 'teacher_id', 'id', 'id', 'training_id');
    }
}
