<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'A first name is required!',
            'middle_name.required' => 'A middle name is required!',
            'last_name.required' => 'A last name is required!',
            'email.required' => 'An email is required before continuing!',
            'phone_number.required' => 'A phone number is required before continuing!',
        ];
    }
}
