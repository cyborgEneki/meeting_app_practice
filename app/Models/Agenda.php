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
            'user_id',
            'agenda_status',
            'conclusion'
        ];

    public function meeting()
    {
        return $this->belongsTo('App\Meeting');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
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
