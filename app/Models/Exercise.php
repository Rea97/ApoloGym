<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'client_id',
        'name',
        'worked_muscle',
        'picture',
        'reps',
        'sets',
        'weight',
        'date',
        'finish'
    ];
}
