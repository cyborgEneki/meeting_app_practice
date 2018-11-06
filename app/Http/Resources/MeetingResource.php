<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
//            'creator' => UserResource::collection($this->creator),
            'creator' => $this->creator,
            'facilitator' => $this->facilitator,
            'time_keeper' => $this->time_keeper,
            'users' => UserResource::collection($this->users),
            'agendas' =>AgendaResource::collection($this->agendas),
            'venue' => $this->venue,
            'media' => $this->media,
            'meetingseries' => $this->meetingseries,
            'meetingtype' => $this->meetingtype,
        ];
    }
}
