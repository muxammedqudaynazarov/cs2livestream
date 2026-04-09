<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Typing extends Model
{
    protected $fillable = [
        'name', 'desc', 'slug', 'status', 'type_id'
    ];
}
