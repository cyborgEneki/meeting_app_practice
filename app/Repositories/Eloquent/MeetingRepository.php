<?php

namespace App\Repositories;

/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 26/09/2018
 * Time: 10:57 PM
 */

use App\Http\Requests\EditMeetingRequest;
use App\Http\Requests\MeetingRequest;
use App\Http\Requests\MeetingseriesRequest;
use App\Http\Resources\MeetingResource;
use App\User;
use App\Http\Resources\MeetingWithoutRelatedDataResource;
use App\Meeting;
use App\Meetingseries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingRepository implements MeetingRepositoryInterface
{
    protected $agendaRepository;

    public function __construct(AgendaRepository $agendaRepository)
    {
        $this->agendaRepository = $agendaRepository;
    }

    public function allMeetings()
    {
//        return MeetingResource::collection(Meeting::all());
        return MeetingResource::collection(Meeting::take(10)->get());
    }

    public function allSimpleMeetings()
    {
//        return MeetingWithoutRelatedDataResource::collection(Meeting::all());
        return MeetingWithoutRelatedDataResource::collection(Meeting::take(10)->get());
    }

    /**
     * @param Request $request
     * @return MeetingResource
     */
    public function createMeeting(MeetingRequest $request)
    {
        $request['creator_id'] = Auth::id();
        $meeting = Meeting::create($request->all());

        if ($meeting->meetingseries_id) { 
        $meetingseries = Meetingseries::findOrFail($meeting->meetingseries_id);
        $usersInSeries = $meetingseries->users()->get();
        $meeting->users()->attach($usersInSeries);
        };
        
        return new MeetingResource($meeting);
    }

    public function showMeeting($id)
    {
        $meeting = Meeting::findOrFail($id);
        return new MeetingResource($meeting);
    }

    public function updateMeeting(Request $request, Meeting $meeting)
    {
        $meeting->update($request->all());
//        $meeting->users()->sync($request->users);
        if ($meeting->meetingseries_id) { 
            $meetingseries = Meetingseries::findOrFail($meeting->meetingseries_id);
            $usersInSeries = $meetingseries->users()->get();
            $meeting->users()->syncWithoutDetaching($usersInSeries);
        };

        return new MeetingResource($meeting);
    }

    /**
     * @param Meeting $meeting
     * @return bool|null
     * @throws \Exception
     */
    public function deleteMeeting($id)
    {
        $meeting = Meeting::findOrFail($id);

        $meeting->users()->detach();

        return $meeting->delete($meeting);
    }

    public function addUser($meetingId, $userId)
    {
        $meeting = Meeting::findOrFail($meetingId);
        $meeting->users()->attach($userId);
        return $meeting;
    }

    public function removeUser($meetingId, $userId)
    {
        $meeting = Meeting::findOrFail($meetingId);
        $meeting->users()->detach($userId);
        return $meeting;
    }
}