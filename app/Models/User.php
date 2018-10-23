<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class  User extends Authenticatable
{
    use Notifiable, HasApiTokens;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard_name = 'api';
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
        return $this->hasMany('App\Agenda');
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
