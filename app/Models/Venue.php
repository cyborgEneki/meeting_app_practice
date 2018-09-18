<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = ['name'];

    public function meetings()
    {
        return $this->hasMany('App\Meeting');
    }
}
