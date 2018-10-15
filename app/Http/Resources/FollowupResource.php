<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FollowupResource extends JsonResource
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
            'agenda_id' => $this->agenda_id,
            'action' => $this->action,
            'timeline' => $this->timeline,
            'status' => $this->status,
        ];
    }
}
