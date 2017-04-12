<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $guard = 'client';

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
