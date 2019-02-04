<?php

namespace App\Listeners;

use App\Events\RescheduledMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\MeetingRescheduledAlertMail;
use App\Events\MeetingRescheduledAlert;

class MeetingRescheduledDone
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MeetingAlert  $event
     * @return void
     */
    public function handle(MeetingRescheduledAlert $event)
    {
        foreach ($event->meeting->users as $user)
        {
            Mail::to($user->email)->send(new MeetingRescheduledAlertMail($event->meeting));
        }
    }
}
