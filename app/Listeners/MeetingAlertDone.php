<?php

namespace App\Listeners;

use App\Events\MeetingAlert;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertMail;

class MeetingAlertDone
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
    public function handle(MeetingAlert $event)
    {
        foreach ($event->meeting->users as $user)
        {
            Mail::to($user->email)->send(new AlertMail($event->meeting));
        }
    }
}
