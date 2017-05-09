<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Message extends Model
{
    protected $fillable = ['sender_id', 'recipient_id', 'content'];

    public function sender()
    {
        return $this->belongsTo(Authenticatable::class, 'sender_id');
    }
}
