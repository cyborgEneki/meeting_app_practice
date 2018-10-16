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
                'id' => $this->id,
                'meeting_id' => $this->meeting_id,
                'user_id' => $this->user_id,
                'topic' => $this->topic,
                'description' => $this->description,
                'time_allocated' => $this->time_allocated,
                'agenda_status' => $this->agenda_status,
                'conclusion' => $this->conclusion,
                'followups' => FollowupResource::collection($this->followups),
                'discussion' => DiscussionResource::collection($this->discussions),
            ];
    }
}
