<?php

namespace App\Http\Requests;

use App\Utilities\Validation\InstructorValidation;
use Illuminate\Foundation\Http\FormRequest;
use App\Utilities\AuthVerification;
use App\Utilities\Validation\InstructorScheduleValidation;

class StoreInstructorRequest extends FormRequest
{
    use AuthVerification, InstructorValidation, InstructorScheduleValidation;
    //use AuthVerification, InstructorValidation, InstructorScheduleValidation {
    //    InstructorScheduleValidation::getRules as getScheduleRules;
    //}

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $instructorRules = $this->getRules();
        $instructorRules['password'] = 'required|min:6|confirmed';
        $rules = array_merge($instructorRules, $this->getScheduleRules());
        return $rules;
    }

    public function messages()
    {
        return [
            'after' => 'El campo :attribute debe ser una hora después de :date.'
        ];
    }
}
