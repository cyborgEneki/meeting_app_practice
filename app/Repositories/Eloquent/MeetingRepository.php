<?php

namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 26/09/2018
 * Time: 10:57 PM
 */

use App\Agenda;
use App\Http\Resources\MeetingResource;
use App\Meeting;
use Illuminate\Http\Request;

class MeetingRepository implements MeetingRepositoryInterface
{
    public function allMeetings()
    {
        return MeetingResource::collection(Meeting::all());
    }
    /**
     * @param Request $request
     * @return MeetingResource
     */
    public function createMeeting(Request $request)
    {
        $meeting = Meeting::create($request->all());

        $meeting->users()->attach($request->users);

        $agenda = Agenda::create($request->all());
//        $meeting->agendas()->save($agenda);
        $meeting->agendas()->attach($request->agendas);

        $meeting->save();
        return new MeetingResource($meeting);
    }
    public function showMeeting($id)
    {
        $meetings = Meeting::find($id);
        return new MeetingResource($meetings);
    }
    public function updateMeeting(Request $request, Meeting $meeting)
    {
        $updatedMeeting = $meeting->update($request->all());
        $meeting->users()->sync($request->users);
        $meeting->users()->sync($request->agendas);
        return new MeetingResource($updatedMeeting);
    }
    /**
     * @param Meeting $meeting
     * @return bool|null
     * @throws \Exception
     */
    public function deleteMeeting(Meeting $meeting)
    {
        $meeting->users()->detach();
        return $meeting->delete($meeting);
    }
}