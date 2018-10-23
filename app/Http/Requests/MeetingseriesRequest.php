<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeetingseriesRequest extends FormRequest
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
            'name' => 'required',
            'frequency' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Kindly name this meeting series before continuing',
            'frequency.required' => 'Frequency is required!',
        ];
    }
}
