<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Game extends Model
{

    protected $fillable = [
        'tournament_id',
        'team_1_id',
        'team_2_id',
        'stage',
        'status',
        'format',
        'scheduled_at',
        'veto',
        'confirmed',
    ];
    protected $casts = [
        'confirmed' => 'array',
        'veto' => 'array',
    ];

    public function team1(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'team_1_id');
    }

    public function team2(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'team_2_id');
    }
}
