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
use App\User;
use Illuminate\Http\Request;

class MeetingRepository implements MeetingRepositoryInterface
{
    public function allMeetings()
    {
        return MeetingResource::collection(Meeting::all());
    }

    public function createMeeting(Request $request)
    {
        $meeting = Meeting::create($request->all());

        $meeting->save();

        $user = User::find([3, 4]);
        $meeting->users()->attach($user);

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