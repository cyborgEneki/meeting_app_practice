<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeetingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'creator' => 'required',
            'facilitator' => 'required',
            'time_keeper' => 'required',
            'meetingseries_id' => 'required',
        ];
    }
}
