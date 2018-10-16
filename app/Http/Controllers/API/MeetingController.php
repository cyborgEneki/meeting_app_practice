<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\User;
use App\Repositories\AgendaRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MeetingRepositoryInterface;
use App\Events\MeetingAlert;

class MeetingController extends Controller
{
    protected $meetingRepository;

    public function __construct(MeetingRepositoryInterface $meetingRepository)
    {
        $this->meetingRepository = $meetingRepository;
    }

    public function index()
    {
        $meetings = $this->meetingRepository->allMeetings();
        return $meetings;
    }

    public function indexSimpleMeetings()
    {
        $meetings = $this->meetingRepository->allSimpleMeetings();
        return $meetings;
    }

    /**
     * @param Request $request
     * @param $meeting
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $meeting = $this->meetingRepository->createMeeting($request);
        event(new MeetingAlert($meeting));
        return response()->json(['message' => 'Meeting created successfully.'], 201);
    }

    public function show($id)
    {
        $meetings = $this->meetingRepository->showMeeting($id);
        return $meetings;
    }

    /**
     * @param Request $request
     * @param Meeting $meeting
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Meeting $meeting)
    {
        $this->meetingRepository->updateMeeting($request, $meeting);
        return response()->json(['You have successfully updated your meeting.'], 200);
    }

    /**
     * @param Meeting $meeting
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Meeting $meeting)
    {
        $this->meetingRepository->deleteMeeting($meeting);
        return response()->json(['success' => 'You have successfully deleted your meeting.'], 200);
    }

    public function attachUser($meetingId, $userId)
    {
        $this->meetingRepository->addUser($meetingId, $userId);
        return response()->json(['success' => 'User added to meeting_user'], 200);
    }

    public function detachUser($meetingId, $userId)
    {
        $this->meetingRepository->removeUser($meetingId, $userId);
        return response()->json(['success' => 'User deleted from meeting_user'], 200);
    }
}
