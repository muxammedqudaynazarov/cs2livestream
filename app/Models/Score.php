<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Score extends Model
{
    public function game(): HasOne
    {
        return $this->hasOne(Game::class, 'id', 'game_id');
    }
}
