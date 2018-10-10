<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['user_id', 'topic', 'description'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function meeting()
    {
        return $this->belongsTo('App\Meeting');
    }
}
