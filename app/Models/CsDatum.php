<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CsDatum extends Model
{
    protected $table = 'cs_data';
    protected $fillable = [
        'data',
    ];
}
