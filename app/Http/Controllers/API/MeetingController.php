<?php

namespace App\Http\Controllers;

use App\Http\Resources\MeetingResource;
use App\Meeting;
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

        dd($meetings);

        return response()->json($meetings, 200);
    }

    /**
     * @param Request $request
     * @param $meeting
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Meeting $meeting)
    {
        $this->meetingRepository->createMeeting($request);

        event(new MeetingAlert($meeting));

        return response()->json(['message' => 'Meeting created successfully.'], 201);
    }

    public function show($id)
    {
        $meetings = $this->meetingRepository->showMeeting($id);

        return new MeetingResource($meetings);
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
