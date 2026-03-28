<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class University extends Model
{
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class, 'university_id', 'id');
    }
}
