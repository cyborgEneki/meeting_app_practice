<?php

namespace App\Repositories;

/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 26/09/2018
 * Time: 10:57 PM
 */

use App\Http\Resources\MeetingResource;
use App\Http\Resources\MeetingWithoutRelatedDataResource;
use App\Meeting;
use Illuminate\Http\Request;

class MeetingRepository implements MeetingRepositoryInterface
{
    protected $agendaRepository;

    public function __construct(AgendaRepository $agendaRepository)
    {
        $this->agendaRepository = $agendaRepository;
    }

    public function allMeetings()
    {
        return MeetingResource::collection(Meeting::all());
    }

    public function allSimpleMeetings()
    {
        return MeetingWithoutRelatedDataResource::collection(Meeting::all());
    }

    /**
     * @param Request $request
     * @return MeetingResource
     */
    public function createMeeting(Request $request)
    {
        $meeting = Meeting::create($request->all());

        $meeting->users()->attach($request->users);

        foreach ($request->agendas as $agendadata)
        {
            $agendadata['meeting_id'] =$meeting->id;
            $agendarequest = new Request($agendadata);
            $this->agendaRepository->createAgenda($agendarequest);
        }

        $meeting->save();
        return new MeetingResource($meeting);
    }

    public function showMeeting($id)
    {
        $meeting = Meeting::find($id);
        return new MeetingResource($meeting);
    }

    public function updateMeeting(Request $request, Meeting $meeting)
    {
        $updatedMeeting = $meeting->update($request->all());
        $meeting->users()->sync($request->users);

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