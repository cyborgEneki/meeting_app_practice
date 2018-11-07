<?php

namespace App\Http\Resources;

use App\User;
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
            'creator' => new UserResource(User::find($this->creator)),
            'facilitator' => new UserResource(User::find($this->facilitator)),
            'time_keeper' => new UserResource(User::find($this->time_keeper)),
            'users' => UserResource::collection($this->users),
            'agendas' =>AgendaResource::collection($this->agendas),
            'venue' => $this->venue,
            'media' => $this->media,
            'meetingseries' => $this->meetingseries,
            'meetingtype' => $this->meetingtype,
        ];
    }
}
