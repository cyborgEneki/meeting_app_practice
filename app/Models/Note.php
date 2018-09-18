<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['topic', 'description'];

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
