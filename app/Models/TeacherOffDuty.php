<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TeacherOffDuty extends Model
{
    protected $fillable = [
        'teacher_id',
        'from',
        'until',
        'teaching_days',
        'reason_type_id',
    ];

    protected $casts = [
        'from' => 'date',
        'until' => 'date',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function reason(): HasOne
    {
        return $this->hasOne(OffDutyReason::class, 'id', 'reason_type_id');
    }
}
