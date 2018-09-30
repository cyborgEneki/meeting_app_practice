<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 28/09/2018
 * Time: 10:27 PM
 */
namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\MeetingRepositoryInterface',
            'App\Repositories\MeetingRepository');

        $this->app->bind('App\Repositories\NoteRepositoryInterface',
            'App\Repositories\NoteRepository');

        $this->app->bind('App\Repositories\MeetingtypeRepositoryInterface',
            'App\Repositories\MeetingtypeRepository');

        $this->app->bind('App\Repositories\AgendaRepositoryInterface',
            'App\Repositories\AgendaRepository');
    }
}
