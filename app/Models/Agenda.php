<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable =
        [
            'meeting_id',
            'topic',
            'description',
            'time_allocated',
            'owner',
            'agenda_status',
            'conclusion'
        ];

    public function meeting()
    {
        return $this->belongsTo('App\Meeting');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'owner');
    }

    public function discussions()
    {
        return $this->hasMany('App\Discussion');
    }

    public function followups()
    {
        return $this->hasMany('App\Followup');
    }
}
