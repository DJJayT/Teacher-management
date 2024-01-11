<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TeacherTraining extends Model
{
    protected $fillable = [
        'teacher_id',
        'training_id',
        'training_from',
        'training_until',
        'duration',
    ];

    protected $casts = [
        'training_from' => 'date',
        'training_until' => 'date',
    ];

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }

    public function training(): HasOne
    {
        return $this->hasOne(Training::class);
    }
}
