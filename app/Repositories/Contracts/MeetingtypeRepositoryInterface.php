<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 9:00 PM
 */

namespace App\Repositories;

use App\Http\Requests\MeetingtypeRequest;
use App\Meetingtype;
use Illuminate\Http\Request;

interface MeetingtypeRepositoryInterface
{
    public function allMeetingtypes();

    public function createMeetingtype(MeetingtypeRequest $request);

    public function updateMeetingtype(MeetingtypeRequest $request, Meetingtype $meetingtype);

    public function deleteMeetingtype(Meetingtype $meetingtype);
}