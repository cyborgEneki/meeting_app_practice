<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meetingseries extends Model
{
    protected $fillable = ['name', 'frequency'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'meetingseries_user',
            'meetingseries_id', 'user_id');
    }

    public function meetings()
    {
        return $this->hasMany('App\Meeting');
    }
}