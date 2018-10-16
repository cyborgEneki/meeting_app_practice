<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 9:02 PM
 */

namespace App\Repositories;

use App\Http\Resources\MeetingseriesResource;
use App\Meetingseries;
use Illuminate\Http\Request;

class MeetingseriesRepository implements MeetingseriesRepositoryInterface
{
    protected $meetingseriesRepository;

    public function allMeetingseries()
    {
        return MeetingseriesResource::collection(Meetingseries::all());
    }

    public function createMeetingseries(Request $request)
    {
        return Meetingseries::create($request->all());
    }

    public function updateMeetingseries(Request $request, Meetingseries $meetingseries)
    {
        return $meetingseries->update($request->all());
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
}