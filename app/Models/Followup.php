<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    protected $fillable = ['agenda_id', 'action', 'owner', 'timeline', 'status'];

    public function agenda()
    {
        return $this->belongsTo('App\Agenda');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'followup_user',
            'followup_id', 'user_id');
    }
}
