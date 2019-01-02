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
            'creator_id' => $this->creator_id,
            'chair_id' => $this->chair_id,
            'secretary_id' => $this->secretary_id,
            'users' => $this->users,
            'agendas' =>AgendaResource::collection($this->agendas),
            'venue_id' => $this->venue_id,
            'media_id' => $this->media_id,
            'meetingseries_id' => $this->meetingseries_id,
            'meetingtype_id' => $this->meetingtype_id,
        ];
    }
}
