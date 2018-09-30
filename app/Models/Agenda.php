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
            'presenter',
            'owner',
            'agenda_status',
            'conclusion'
        ];

    public function meeting()
    {
        return $this->belongsTo('App\Meeting');
    }

    public function presenter()
    {
        return $this->belongsTo('App\User', 'presenter');
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
