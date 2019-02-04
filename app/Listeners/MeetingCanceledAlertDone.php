<?php

namespace App\Listeners;

use App\Events\MeetingCanceledAlert;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\MeetingCanceledAlertMail;

class MeetingCanceledAlertDone
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

    public function handle(MeetingCanceledAlert $event)
    {
        foreach ($event->meeting->users as $user) {
            Mail::to($user->email)->send(new MeetingCanceledAlertMail($event->meeting));
        }
    }
}
