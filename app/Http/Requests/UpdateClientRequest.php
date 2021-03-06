<?php

namespace App\Http\Requests;

use App\Utilities\Validation\ClientValidation;
use Illuminate\Foundation\Http\FormRequest;
use App\Utilities\AuthVerification;

class UpdateClientRequest extends FormRequest
{
    use ClientValidation, AuthVerification;

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
        return $this->getRules();
    }
}
