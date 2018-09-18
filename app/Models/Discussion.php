<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['description'];

    public function agenda()
    {
        return $this->belongsTo('App\Agenda');
    }
}
