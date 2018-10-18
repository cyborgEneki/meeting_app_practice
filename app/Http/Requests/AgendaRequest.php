<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest
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
            'topic' => 'required',
            'description' => 'required',
            'time_allocated' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'topic.required' => 'Topic is required!',
            'description.required' => 'Description is required!',
            'time_allocated.required' => 'The time allocated for this meeting is required!',
        ];
    }
}
