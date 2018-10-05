<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 9:02 PM
 */

namespace App\Repositories;

use App\Http\Resources\MeetingtypeResource;
use App\Meetingtype;
use Illuminate\Http\Request;

class MeetingtypeRepository implements MeetingtypeRepositoryInterface
{
    public function allMeetingtype()
    {
        return MeetingtypeResource::collection(Meetingtype::all());
    }

    public function createMeetingtype(Request $request)
    {
        return Meetingtype::create($request->all());
    }

    public function updateMeetingtype(Request $request, Meetingtype $meetingtype)
    {
        return $meetingtype->update($request->all());
    }

    /**
     * @param Meetingtype $meetingtype
     * @return bool|null
     * @throws \Exception
     */
    public function deleteMeetingtype(Meetingtype $meetingtype)
    {
        return $meetingtype->delete($meetingtype);
    }
}