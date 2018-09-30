<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MeetingRepositoryInterface;

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

        return response()->json($meetings, 200);
    }

    public function store(Request $request)
    {
        $meetings = $this->meetingRepository->createMeeting($request);

        return response()->json($meetings, 201);
    }

    public function show(Meeting $meeting)
    {
        return response()->json($meeting, 200);
    }

    /**
     * @param Request $request
     * @param Meeting $meeting
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Meeting $meeting)
    {
        if (Auth::id() !== $meeting->creator)
        {
            return response()->json(['error' => 'You can only edit meetings that you create.'], 403);
        }

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
        if (Auth::id() !== $meeting->creator)
        {
            return response()->json(['error' => 'You can only delete meetings that you create.'], 403);
        }

        $this->meetingRepository->deleteMeeting($meeting);

        return response()->json(['success' => 'You have successfully deleted your meeting.'], 204);
    }
}
