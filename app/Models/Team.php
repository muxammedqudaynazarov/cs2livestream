<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'tag', 'logo', 'form_id', 'creator_id', 'captain_id', 'join_url', 'status'
    ];

    public function captain(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }

    public function players(): HasMany
    {
        return $this->hasMany(UserTeam::class, 'team_id', 'id');
    }

    public function gamesAsTeam1(): HasMany
    {
        return $this->hasMany(Game::class, 'team_1_id');
    }

    public function gamesAsTeam2(): HasMany
    {
        return $this->hasMany(Game::class, 'team_2_id');
    }

    public function getAllGamesAttribute()
    {
        return $this->gamesAsTeam1->merge($this->gamesAsTeam2);
    }

    public function getWinsCountAttribute()
    {
        return $this->all_games->filter(function ($game) {
            return ($game->team_1_id == $this->id && $game->win == 't1') ||
                ($game->team_2_id == $this->id && $game->win == 't2');
        })->count();
    }

    public function getLossesCountAttribute()
    {
        return $this->all_games->filter(function ($game) {
            return ($game->team_1_id == $this->id && $game->win == 't2') ||
                ($game->team_2_id == $this->id && $game->win == 't1');
        })->count();
    }

}
