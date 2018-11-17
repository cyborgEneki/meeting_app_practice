<?php

namespace App\Repositories;

use App\Http\Requests\MeetingRequest;
use App\Meeting;
use Illuminate\Http\Request;

interface MeetingRepositoryInterface
{
    public function allMeetings();

    public function allSimpleMeetings();

    public function createMeeting(MeetingRequest $request);

    public function showMeeting($id);

    public function updateMeeting(MeetingRequest $request, Meeting $meeting);

    public function deleteMeeting($id);

    public function addUser($meetingId, $userId);

    public function removeUser($meetingId, $userId);
}