<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;
use App\Http\Resources\MeetingResource;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MeetingRepositoryInterface;

class MeetingController extends Controller
{

    public function __construct(MeetingRepositoryInterface $meeting)
    {
        $this->meeting = $meeting;
    }

    public function index()
    {
        return MeetingResource::collection(Meeting::all());
    }

    public function store(Request $request)
    {
        $meetings = $this->meeting->createMeeting($request);

        return response()->json($meetings, 201);
    }

    public function show(Meeting $meeting)
    {
//        $meeting = Meeting::find($meeting);

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

        $this->meeting->updateMeeting($request, $meeting);

        return response()->json(['You have successfully updated your meeting.'], 200);
    }

    /**
     * @param Meeting $meeting
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Meeting $meeting)
    {
        $this->meeting->deleteMeeting($meeting);

        return response()->json(null, 204);
    }
}
