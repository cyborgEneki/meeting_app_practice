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

    public function users()
    {
        return $this->belongsToMany('App\User', 'agenda_user',
            'agenda_id', 'user_id');
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
