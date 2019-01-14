<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Followup extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'followups.action' => 10
        ]
    ];

    protected $fillable = ['agenda_id', 'action', 'timeline', 'status'];

    public function agenda()
    {
        return $this->belongsTo('App\Agenda');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'followup_user',
            'followup_id', 'user_id');
    }
}
