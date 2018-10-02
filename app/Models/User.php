<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class  User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'phone_number', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function followups()
    {
        return $this->belongsToMany('App\Followup', 'followup_user',
            'user_id', 'followup_id');
    }

    public function agendas()
    {
        return $this->belongsToMany('App\Agenda', 'agenda_user',
            'user_id', 'agenda_id');
    }

    public function meetingseries()
    {
        return $this->belongsToMany('App\Meetingseries', 'meetingseries_user',
            'user_id', 'meetingseries_id');
    }

    public function meetings()
    {
        return $this->belongsToMany('App\Meeting', 'meeting_user',
            'user_id', 'meeting_id');
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
    }
}
