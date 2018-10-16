<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 9:02 PM
 */

namespace App\Repositories;

use App\Http\Requests\MeetingtypeRequest;
use App\Http\Resources\MeetingtypeResource;
use App\Meetingtype;
use Illuminate\Http\Request;

class MeetingtypeRepository implements MeetingtypeRepositoryInterface
{
    protected $meetingRepository;

    public function __construct(MeetingRepository $meetingRepository)
    {
        $this->meetingRepository = $meetingRepository;
    }

    public function allMeetingtypes()
    {
        return MeetingtypeResource::collection(Meetingtype::all());
    }

    public function createMeetingtype(MeetingtypeRequest $request)
    {
        $meetingtype = Meetingtype::create($request->all());
        return new MeetingtypeResource($meetingtype);
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