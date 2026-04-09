<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserTeam extends Model
{
    protected $fillable = [
        'user_id',
        'team_id',
        'status',
        'kills',
        'deaths',
        'assists',
        'mvps',
        'damages',
        'ratio',
        'damages_array',
        'ratio_array',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function team(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
