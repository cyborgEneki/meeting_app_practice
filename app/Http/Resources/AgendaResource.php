<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgendaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
            [
                'meeting_id' => $this->meeting_id,
                'topic' => $this->topic,
                'description' => $this->description,
                'time_allocated' => $this->time_allocated,
                'user_id' => $this->user_id,
                'agenda_status' => $this->agenda_status,
                'conclusion' => $this->conclusion,
                'followups' => $this->followups,
            ];
    }
}
