<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;
use App\Http\Resources\MeetingResource;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MeetingRepositoryInterface;

class MeetingController extends Controller
{
    private $meetingRepo;

    public function __construct(MeetingRepositoryInterface $meetingRepository)
    {
        $this->meetingRepo = $meetingRepository;
    }

    public function index()
    {
        return MeetingResource::collection(Meeting::all());
    }

    public function store(Request $request)
    {

//        $meeting = Meeting::create($request->all());

        $meeting = $this->meetingRepo->createMeeting($request->all());

        return response()->json($meeting, 201);
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
        if (Auth::id() !== $meeting->creator) {
            return response()->json(['error' => 'You can only edit meetings that you create.'], 403);
        }

        $meeting->update($request->all());

        return response()->json(['You have successfully updated your meeting.'], 200);
    }

    /**
     * @param Meeting $meeting
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();

        return response()->json(null, 204);
    }
}
