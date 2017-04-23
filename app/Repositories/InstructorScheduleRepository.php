<?php

namespace App\Repositories;

use App\Models\Instructor;
use App\Models\InstructorSchedule;
use Illuminate\Http\Request;

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

    public function storeSchedule(Request $request, Instructor $instructor)
    {
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        for ($i = 0; $i < 7; $i++) {
            $saved = $this->instructorSchedule->create([
                'instructor_id' => $instructor->id,
                'day' => $i + 1,
                'from' => $request->input($days[$i].'-from', null),
                'to' => $request->input($days[$i].'-to', null),
                'hours' => getHoursDiff(
                    $request->input($days[$i].'-from', null),
                    $request->input($days[$i].'-to', null)
                )
            ]);
            if (! $saved) {
                return false;
            }
        }
        return true;
    }

}