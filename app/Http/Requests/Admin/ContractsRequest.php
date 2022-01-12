<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ContractsRequest extends FormRequest
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
            'title' => ['required',Rule::unique('contracts')->ignore($this->contract)]
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'This field is required.',
            'title.unique' => 'This field must be unique.'
        ];
    }
}
