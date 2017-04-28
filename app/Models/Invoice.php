<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['client_id', 'total', 'due_date', 'state'];

    public function services()
    {
        return $this->belongsToMany('App\Models\Service')->withTimestamps();
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
}
