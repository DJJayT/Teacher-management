<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TeacherSickTime extends Model
{
    protected $fillable = [
        'teacher_id',
        'from',
        'until',
        'teaching_days',
        'total_days',
        'reason_type_id',
        'certificate',
        'certificate_from',
        'hospital',
    ];

    protected $casts = [
        'from' => 'date',
        'until' => 'date',
        'certificate' => 'bool',
        'certificate_from' => 'date',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function reason(): HasOne
    {
        return $this->hasOne(SickTimeReason::class, 'id', 'reason_type_id');
    }
}
