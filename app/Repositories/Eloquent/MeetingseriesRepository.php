<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 9:02 PM
 */

namespace App\Repositories;

use App\Http\Requests\MeetingseriesRequest;
use App\Http\Resources\MeetingseriesResource;
use App\Meetingseries;
use Illuminate\Http\Request;

class MeetingseriesRepository implements MeetingseriesRepositoryInterface
{
    protected $meetingseriesRepository;

    public function allMeetingseries()
    {
//        return MeetingseriesResource::collection(Meetingseries::all());
        return MeetingseriesResource::collection(Meetingseries::take(10)->get());
    }

    public function createMeetingseries(MeetingseriesRequest $request)
    {
        return Meetingseries::create($request->all());
    }

    public function showMeetingseries($id)
    {
        $meetingseries = Meetingseries::findOrFail($id);
        return new MeetingseriesResource($meetingseries);
    }

    public function updateMeetingseries(MeetingseriesRequest $request, Meetingseries $meetingseries)
    {
        $meetingseries->update($request->all());
        // return new MeetingseriesResource($meetingseries);
        return MeetingseriesResource::collection;
    }

    /**
     * @param Meetingseries $meetingseries
     * @return bool|null
     * @throws \Exception
     */
    public function deleteMeetingseries(Meetingseries $meetingseries)
    {
        return $meetingseries->delete($meetingseries);
    }

    public function addUser($meetingseriesId, $userId)
    {
        $meeting = Meetingseries::findOrFail($meetingseriesId);
        $meeting->users()->attach($userId);
        return $meetingseries;
    }

    public function removeUser($meetingseriesId, $userId)
    {
        $meeting = Meetingseries::findOrFail($meetingseriesId);
        $meeting->users()->detach($userId);
        return $meetingseries;
    }
}