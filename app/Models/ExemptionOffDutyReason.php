<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExemptionOffDutyReason extends Model
{
    protected $fillable = [
        'reason',
    ];

    public function teacherExemptionOffDuties(): BelongsToMany
    {
        return $this->belongsToMany(TeacherOffDuty::class);
    }
}
