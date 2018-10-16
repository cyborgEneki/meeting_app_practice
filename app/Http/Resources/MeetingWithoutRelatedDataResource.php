<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingWithoutRelatedDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
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
            'creator' => $this->creator,
            'facilitator' => $this->facilitator,
            'time_keeper' => $this->time_keeper,
            'venue_id' => $this->venue_id,
            'media_id' => $this->media_id,
            'meetingtype_id' => $this->meetingtype_id,
            'meetingseries_id' => $this->meetingseries_id,
        ];
    }
}
