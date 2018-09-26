<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 26/09/2018
 * Time: 11:44 PM
 */

namespace App\Providers;

use App\Repositories\MeetingRepository;
use App\Repositories\MeetingRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            MeetingRepositoryInterface::class,
            MeetingRepository::class
        );
    }
}