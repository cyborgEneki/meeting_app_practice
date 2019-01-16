<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 9:00 PM
 */

namespace App\Repositories;

use App\Http\Requests\MeetingseriesRequest;
use App\Meetingseries;
use Illuminate\Http\Request;

interface MeetingseriesRepositoryInterface
{
    public function allMeetingseries();

    public function createMeetingseries(MeetingseriesRequest $request);

    public function updateMeetingseries(MeetingseriesRequest $request, Meetingseries $meetingseries);

    public function deleteMeetingseries(Meetingseries $meetingseries);

    public function addUser($meetingseriesId, $userId);

    public function removeUser($meetingseriesId, $userId);
}