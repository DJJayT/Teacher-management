<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TeacherTraining extends Model
{
    protected $fillable = [
        'teacher_id',
        'training_id',
        'from',
        'until',
        'duration',
    ];

    protected $casts = [
        'from' => 'date',
        'until' => 'date',
    ];

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }

    public function training(): HasOne
    {
        return $this->hasOne(Training::class, 'id', 'training_id');
    }
}
