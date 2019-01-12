<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Discussion extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'discussions.description' => 10
        ]
    ];

    protected $fillable = ['description', 'agenda_id'];

    public function agenda()
    {
        return $this->belongsTo('App\Agenda');
    }
}
