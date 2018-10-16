<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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
        return $this->belongsTo('App\Venue');
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
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
    public function scopeAddAgenda($id)
    {
        $meeting = Meeting::find($id);
        $agenda = Agenda::create([
            'meeting_id' => $meeting->id,
            'topic' => request('topic'),
            'description' => request('description'),
            'time_allocated' => request('time_allocated'),
            'presenter' => request('presenter'),
            'agenda_status' => request('agenda_status'),
            'conclusion' => request('conclusion')
        ]);
        return $agenda;
    }
}
