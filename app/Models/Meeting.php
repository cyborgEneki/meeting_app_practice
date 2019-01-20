<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Requests\AgendaRequest;
use Nicolaslopezj\Searchable\SearchableTrait;

class Meeting extends Model
{
    use SoftDeletes;
    use SearchableTrait;

    protected $dates = ['deleted_at'];
    protected $fillable =
        [
            'name',
            'date',
            'start_time',
            'end_time',
            'creator_id',
            'chair_id',
            'secretary_id',
            'media_id',
            'venue_id',
            'meetingtype_id',
            'meetingseries_id',
            'locked'
        ];

    protected $events =
        [
            'created' => Events\MeetingAlert::class
        ];

    protected $searchable = [
        'columns' => [
            'meetings.name' => 10
        ],
    ];

    public $appends =
        [
            'meetingseries',
            'meetingtype'
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

    public function meetingtype()
    {
        return $this->belongsTo('App\Meetingtype');
    }

    public function meetingseries()
    {
        return $this->belongsTo('App\Meetingseries');
    }

    public function chair()
    {
        return $this->belongsTo('App\User', 'chair_id');
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }

    public function secretary()
    {
        return $this->belongsTo('App\User', 'secretary_id');
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
    public function getMeetingseriesAttribute()
    {
        return $this->meetingseries()->first();
    }

    public function getMeetingtypeAttribute()
    {
        return $this->meetingtype()->first();
    }
}
