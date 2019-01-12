<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Agenda extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'agendas.topic' => 10,
            'agendas.description' => 9,
            'agendas.conclusion' => 8,
        ],
    ];

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

    public $appends = ['user'];

    public function meeting()
    {
        return $this->belongsTo('App\Meeting');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function uservotes()
    {
        return $this->belongsToMany('App\User', 'agendas_uservote')->withPivot(['vote']);
    }

    public function discussions()
    {
        return $this->hasMany('App\Discussion');
    }

    public function followups()
    {
        return $this->hasMany('App\Followup');
    }

    public function getUserAttribute()
    {
        return $this->user()->first();
    }
}
