<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'price'];

    public function invoices()
    {
        return $this->belongsToMany('App\Models\Invoice')->withTimestamps();
    }
}
