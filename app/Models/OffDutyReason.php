<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OffDutyReason extends Model
{
    protected $fillable = [
        'reason',
    ];

    public function teacherOffDuties(): BelongsToMany
    {
        return $this->belongsToMany(TeacherOffDuty::class);
    }
}
