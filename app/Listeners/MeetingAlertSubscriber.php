<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 03/10/2018
 * Time: 7:51 PM
 */

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;

class MeetingAlertSubscriber implements ShouldQueue
{
    public function onMeetingCreated($event)
    {

    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\MeetingAlert',
            'App\Listeners\MeetingAlertSubscriber@onMeetingCreated'
        );
    }
}