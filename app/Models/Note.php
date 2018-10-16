<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'meeting_id', 'topic', 'description'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function meeting()
    {
        return $this->belongsTo('App\Meeting');
    }
}
