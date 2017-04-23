<?php

namespace App\Utilities\Validation;

use Illuminate\Validation\Rule;

trait InstructorValidation
{
    /**
     * Retorna un arreglo con las reglas de validación mínimas requeridas para el modelo Instructor.
     *
     * @return array
     */
    protected function getRules()
    {
        return [
            'name'              => 'required|max:40|string',
            'first_surname'     => 'required|max:40|string',
            'second_surname'    => 'nullable|max:40|string',
            'gender'            => 'required|max:1|string',
            'birth_date'        => 'required|date',
            'about_me'          => 'nullable|string|max:1000',
            'profile_picture'   => 'nullable|string',
            'phone_number'      => 'required|string',
            'address'           => 'required|string|max:100',
            'salary'            => 'required',
            'email'             => [
                'required',
                'email',
                'max:255',
                Rule::unique('instructors')->ignore($this->id)
            ]
        ];
    }

}