<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meetingtype extends Model
{
    protected $fillable = ['name'];

    public function meetings()
    {
        return $this->hasMany('App\Meeting');
    }
}
