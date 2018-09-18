<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = ['topic', 'description', 'time_allocated', 'presenter', 'owner',
        'agenda_status', 'conclusion'];

    public function meeting()
    {
        return $this->belongsTo('App\Meeting');
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
}
