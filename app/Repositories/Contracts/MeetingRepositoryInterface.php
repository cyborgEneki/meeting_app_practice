<?php

namespace App\Repositories;

use App\Meeting;
use Illuminate\Http\Request;

interface MeetingRepositoryInterface
{
    public function allMeetings();

    public function createMeeting(Request $request);

    public function updateMeeting(Request $request, Meeting $meeting);

    public function deleteMeeting(Meeting $meeting);
}