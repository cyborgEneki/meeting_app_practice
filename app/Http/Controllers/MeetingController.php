<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;
use App\Http\Resources\MeetingResource;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function index()
    {
        return MeetingResource::collection(Meeting::all());
    }

    public function store(Request $request)
    {

        $meeting = Meeting::create($request->all());

        return new MeetingResource($meeting);
    }

    public function show(Meeting $meeting)
    {
        return new MeetingResource($meeting);
    }

    /**
     * @param Request $request
     * @param Meeting $meeting
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Meeting $meeting)
    {
        dd(Auth::id(), $meeting->creator);

        if (Auth::user() !== $meeting->creator) {
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
