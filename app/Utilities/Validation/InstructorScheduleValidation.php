<?php

namespace App\Utilities\Validation;

use Illuminate\Validation\Rule;

trait InstructorScheduleValidation
{
    /**
     * Retorna un arreglo con las reglas de validación mínimas requeridas para el modelo InstructorSchedule.
     *
     * @return array
     */
    protected function getScheduleRules()
    {
        return [
            'monday-from' => 'required_with:monday-to|date_format:H:i|nullable',
            'monday-to' => 'required_with:monday-from|date_format:H:i|after:monday-from|nullable',
            'tuesday-from' => 'required_with:tuesday-to|date_format:H:i|nullable',
            'tuesday-to' => 'required_with:tuesday-from|date_format:H:i|after:tuesday-from|nullable',
            'wednesday-from' => 'required_with:wednesday-to|date_format:H:i|nullable',
            'wednesday-to' => 'required_with:wednesday-from|date_format:H:i|after:wednesday-from|nullable',
            'thursday-from' => 'required_with:thursday-to|date_format:H:i|nullable',
            'thursday-to' => 'required_with:thursday-from|date_format:H:i|after:thursday-from|nullable',
            'friday-from' => 'required_with:friday-to|date_format:H:i|nullable',
            'friday-to' => 'required_with:friday-from|date_format:H:i|after:friday-from|nullable',
            'saturday-from' => 'required_with:saturday-to|date_format:H:i|nullable',
            'saturday-to' => 'required_with:saturday-from|date_format:H:i|after:saturday-from|nullable',
            'sunday-from' => 'required_with:sunday-to|date_format:H:i|nullable',
            'sunday-to' => 'required_with:sunday-from|date_format:H:i|after:sunday-from|nullable',
        ];
    }

}