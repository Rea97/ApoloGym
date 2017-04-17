<?php

namespace App\Utilities\Validation;

use Illuminate\Validation\Rule;

trait ClientValidation
{
    /**
     * Retorna un arreglo con las reglas de validación mínimas requeridas para el modelo Client.
     *
     * @return array
     */
    protected function getRules()
    {
        return [
            'name'              => 'required|max:40|string',
            'instructor_id'     => 'required|integer',
            'first_surname'     => 'required|max:40|string',
            'second_surname'    => 'max:40|string|nullable',
            'gender'            => 'required|max:1|string',
            'birth_date'        => 'required|date',
            'height'            => 'required|integer|between:120,220',
            //Marca error sin importar que el numero esté entre lo especificado
            //Probablemente es porque en la table está como flotante y quizá
            //between solo funciona para enteros
            //'weight'        => 'required|between:40,250',
            'weight'            => 'required',
            'phone_number'      => 'required|string',
            'address'           => 'required|string|max:100',
            'rfc'               => 'nullable|alpha_num|max:30',
            'profile_picture'   => 'nullable|string',
            'email'             => [
                'required',
                'email',
                'max:255',
                Rule::unique('clients')->ignore($this->id)
            ]
        ];
    }

}