<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SeasonTeam extends Model
{
    protected $fillable = [
        'season_id', 'team_id', 'kills', 'deaths', 'assists', 'mvps', 'ratio', 'ratio_array'
    ];

    public function team(): HasOne
    {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
