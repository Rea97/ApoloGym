<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Instructor extends Authenticatable
{
    use Notifiable;

    /**
     * Guard personalizado para las sesiones de los instructores
     *
     * @var string
     */
    protected $guard = 'instructor';

    // Todos los atributos seran mass assignable, solo para hacer pruebas, corregir después
    protected $guarded = [];

    /**
     * Atributos escondidos de arrays
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relación uno a muchos con modelo Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

    /**
     * Relación uno a muchos con modelo InstructorSchedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedules()
    {
        return $this->hasMany('App\Models\InstructorSchedule');
    }
}
