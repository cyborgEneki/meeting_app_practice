<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MeetingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
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
            'users' => $this->users,
        ];
    }
}
