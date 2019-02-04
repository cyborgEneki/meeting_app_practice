<?php

namespace App\Mail;

use App\Http\Resources\MeetingResource;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class MeetingCanceledAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $meeting;

    public function __construct(MeetingResource $meetingResource)
    {
        $this->meeting = $meetingResource;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->view('meetingcanceled')->subject('Meeting Canceled');
    }
}
