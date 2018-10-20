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
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'creator' => 'required',
            'facilitator' => 'required',
            'time_keeper' => 'required',
            'agendas.*.topic' => 'required',
            'agendas.*.description' => 'required',
            'agendas.*.time_allocated' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'A name must be entered before continuing!',
            'date.required' => 'Date is required!',
            'start_time.required' => 'The start time for this meeting is required!',
            'end_time.required' => 'An end time for this meeting is required!',
            'facilitator.required' => 'A facilitator for this meeting is required!',
            'time_keeper.required' => 'Please assign a time keeper before continuing',
            'agendas.*.topic.required' => 'Each agenda must have a topic',
            'agendas.*.description.required' => 'Each agenda must have a description',
            'agendas.*.time_allocated.required' => 'Each agenda must have a time allocated',

        ];
    }
}
