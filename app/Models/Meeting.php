<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable =
        [
            'name',
            'date',
            'start_time',
            'end_time',
            'creator',
            'facilitator',
            'time_keeper',
            'media_id',
            'venue_id',
            'meetingtype_id',
            'meetingseries_id'
        ];

    protected $events =
        [
            'created' => Events\MeetingAlert::class
        ];

    public function venue()
    {
        return $this->belongsTo('App\Venue', 'venue_id');
    }

    public function media()
    {
        return $this->belongsTo('App\Media');
    }

    public function meetingtypes()
    {
        return $this->belongsTo('App\Meetingtype');
    }

    public function meetingseries()
    {
        return $this->belongsTo('App\Meetingseries');
    }

    public function facilitator()
    {
        return $this->belongsTo('App\User', 'facilitator');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator');
    }

    public function time_keeper()
    {
        return $this->belongsTo('App\User', 'time_keeper');
    }

    public function agendas()
    {
        return $this->hasMany('App\Agenda');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'meeting_user',
            'meeting_id', 'user_id');
    }
}
