<?php

namespace App\Repositories;

use App\Models\InstructorSchedule;

class InstructorScheduleRepository
{
    private $instructorSchedule;

    public function __construct(InstructorSchedule $instructorSchedule)
    {
        $this->instructorSchedule = $instructorSchedule;
    }

    public function scheduleOf($instructor)
    {
        return $this->instructorSchedule
            ->where('instructor_id', '=', $instructor->id)
            ->orderBy('day', 'asc')
            ->get();
    }

    public function makeScheduleArray(array $schedule)
    {
        return [
            'monday' => $schedule[0],
            'tuesday' => $schedule[1],
            'wednesday' => $schedule[2],
            'thursday' => $schedule[3],
            'friday' => $schedule[4],
            'saturday' => $schedule[5],
            'sunday' => $schedule[6]
        ];
    }

}