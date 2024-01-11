<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Provider extends Model
{
    protected $fillable = [
        'name',
    ];

    public function trainings(): BelongsToMany
    {
        return $this->belongsToMany(Training::class);
    }
}
