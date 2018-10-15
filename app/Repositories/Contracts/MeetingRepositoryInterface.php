<?php

namespace App\Repositories;

use App\Meeting;
use Illuminate\Http\Request;

interface MeetingRepositoryInterface
{
    public function allMeetings();

    public function allSimpleMeetings();

    public function createMeeting(Request $request);

    public function showMeeting($id);

    public function updateMeeting(Request $request, Meeting $meeting);

    public function deleteMeeting(Meeting $meeting);

    public function addUser($meetingId, $userId);

    public function removeUser($meetingId, $userId);
}