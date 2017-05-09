<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable;

    /**
     * Atributo que decide por dónde se enviarán las notificaciones.
     * Disponibles: mail, database, broadcast, nexmo y slack.
     * @var array
     */
    public $notificationsVia = ['database'];

    protected $guard = 'client';

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function instructor()
    {
        return $this->belongsTo('App\Models\Instructor');
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message', 'sender_id');
    }

}
