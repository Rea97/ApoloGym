<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorSchedule extends Model
{
    protected $fillable = [
        'instructor_id', 'day', 'from', 'to', 'hours'
    ];

    protected $table = 'instructors_schedule';

    public function instructor()
    {
        return $this->belongsTo('App\Models\Instructor');
    }

}
