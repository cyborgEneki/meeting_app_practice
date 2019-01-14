<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable =
        [
            'user_id',
            'agenda_id',
            'thevote'
        ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function agenda()
    {
        return $this->belongsTo('App\Agenda');
    }

}
