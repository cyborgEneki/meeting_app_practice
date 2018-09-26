<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;
use App\Http\Resources\MeetingResource;

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

    public function update(Request $request, Meeting $meeting)
    {
//      dd($meeting);
        if ($request->user()->id !== $meeting->creator) {
            return response()->json(['error' => 'You can only edit meetings you create.'], 403);
        }

        $meeting->update($request->all());
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
