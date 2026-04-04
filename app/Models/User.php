<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'name',
        'real_name',
        'hemis_id',
        'profile_url',
        'steam_avatar',
        'user_photo',
        'country',
        'pos',
        'rol',
        'group_id',
        'faceit',
    ];

    protected $hidden = [
        'pos', 'rol', 'user_photo',
    ];
}
