<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SickTimeReason extends Model
{
    protected $fillable = [
        'reason',
    ];

    public function teacherSickTimes(): BelongsToMany
    {
        return $this->belongsToMany(TeacherSickTime::class);
    }
}
