<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meetingseries extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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