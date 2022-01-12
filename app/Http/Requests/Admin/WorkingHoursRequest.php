<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkingHoursRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'no_of_hours' => ['required','numeric', Rule::unique('working_hours')->ignore($this->working_hour)]
            
        ];
    }
    public function message()
    {
        return [
        'no_of_hours.numeric'=> 'Numerics only.',
        'no_of_hours.unique'=> ' must be unique.'

        ];
    }
}
