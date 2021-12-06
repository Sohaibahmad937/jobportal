<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriesRequest extends FormRequest
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
            'category_name' =>['regex:/^[a-zA-Z]+$/u','max:255','required',Rule::unique('categories')->ignore($this->category)]
        ];
    }
    public function messages()
    {
        return [
            'category_name.required'=>'Category Name Is Required.',
            'category_name.regex' => 'Numbers cannot be allowed.'
        ];
    }
}
