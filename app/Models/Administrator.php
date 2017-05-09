<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    use Notifiable;

    /**
     * Atributo que decide por dónde se enviarán las notificaciones.
     * Disponibles: mail, database, broadcast, nexmo y slack.
     * @var array
     */
    public $notificationsVia = ['database'];

    protected $fillable = [
        'name', 'email', 'password','first_surname', 'second_surname', 'profile_picture', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'sender_id');
    }
}
