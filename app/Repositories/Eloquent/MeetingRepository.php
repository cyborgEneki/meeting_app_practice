<?php

namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 26/09/2018
 * Time: 10:57 PM
 */

use App\Http\Resources\MeetingResource;
use App\Meeting;
use Illuminate\Http\Request;

class MeetingRepository implements MeetingRepositoryInterface
{
    public function allMeetings()
    {
        return MeetingResource::collection(Meeting::all());
    }

    public function createMeeting(Request $request)
    {
//        return Meeting::create($request->all());

        $meeting = Meeting::create([
            'name' => $request->name,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'creator' => $request->creator,
            'facilitator' => $request->facilitator,
            'time_keeper' => $request->time_keeper,
            'venue_id' => $request->venue_id,
            'media_id' => $request->media_id,
            'meetingtype_id' => $request->meetingtype_id,
            'meetingseries_id' => $request->meetingseries_id,
        ]);

        return new MeetingResource($meeting);
    }

    public function showMeeting($id)
    {
        $meetings = Meeting::find($id);

        return new MeetingResource($meetings);
    }

    public function updateMeeting(Request $request, Meeting $meeting)
    {
        return $meeting->update($request->all());
    }

    /**
     * @param Meeting $meeting
     * @return bool|null
     * @throws \Exception
     */
    public function deleteMeeting(Meeting $meeting)
    {
        return $meeting->delete($meeting);
    }
}