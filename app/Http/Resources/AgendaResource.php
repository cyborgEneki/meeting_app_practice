<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgendaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $agenda = $this->uservotes->where('pivot.agenda_id', $this->id)->first();

        $vote = ($agenda) ? $this->uservotes->where('pivot.agenda_id', $this->id)->first()->pivot : null;

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
                'discussions' => DiscussionResource::collection($this->discussions),
                'vote' => $vote
            ];
    }
}
