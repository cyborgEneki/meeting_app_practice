<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['description', 'agenda_id'];

    public function agenda()
    {
        return $this->belongsTo('App\Agenda');
    }
}
