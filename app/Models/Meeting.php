<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = ['name','date','start_time', 'end_time', 'creator', 'facilitator', 'time_keeper'];

    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }

    public function media()
    {
        return $this->belongsTo('App\Media');
    }

    public function meetingstype()
    {
        return $this->belongsTo('App\Meetingtype');
    }

    public function meetingseries()
    {
        return $this->belongsTo('App\Meetingseries');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'meeting_user',
            'meeting_id', 'user_id');
    }
}
