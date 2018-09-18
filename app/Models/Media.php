<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['name'];

    public function meetings()
    {
        return $this->hasMany('App\Meetings');
    }
}
