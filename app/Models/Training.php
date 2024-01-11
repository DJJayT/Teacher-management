<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Training extends Model
{
    protected $fillable = [
        'title',
        'area',
        'provider',
    ];

    public function providers(): HasOne
    {
        return $this->hasOne(Provider::class);
    }

    public function teachers(): HasManyThrough
    {
        return $this->hasManyThrough(Teacher::class, TeacherTraining::class, 'training_id', 'id', 'id', 'teacher_id');
    }
}
