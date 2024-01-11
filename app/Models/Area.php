<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Area extends Model
{
    protected $fillable = [
        'description',
    ];

    public function trainings(): BelongsToMany
    {
        return $this->belongsToMany(Training::class);
    }
}
