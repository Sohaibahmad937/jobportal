<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceLevelsRequest extends FormRequest
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
            'from_year' =>'nullable|numeric|min:0|max:10|lt:to_year',
            'to_year'=>'required|numeric|max:10|gt:from_year' 
        ];
    }
    public function messages()
    {
        return [
            'from_year.required'=>'This field is required.',
            'from_year.numeric' => 'This field must be numeric.',
            'to_year.required'=>'This field is required.',
            'to_year.numeric' => 'This field must be numeric.'
        ];
    }
}
