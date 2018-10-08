<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:14 PM
 */

namespace App\Repositories;

use App\Agenda;
use App\Followup;
use App\Meeting;
use App\Http\Resources\AgendaResource;
use Illuminate\Http\Request;

class AgendaRepository implements AgendaRepositoryInterface
{
    protected $followupRepository;
    protected $discussionRepository;

    public function __construct
    (
        FollowupRepository $followupRepository,
        DiscussionRepository $discussionRepository
    )
    {
        $this->followupRepository = $followupRepository;
        $this->discussionRepository = $discussionRepository;
    }

    public function allAgendas($meetingId)
    {
        Meeting::find($meetingId);
        return AgendaResource::collection(Agenda::all());
    }

    public function createAgenda(Request $request)
    {
        $agenda = Agenda::create($request->all());

        foreach ($request->followups as $followupData) {
            $followupData['agenda_id'] = $agenda->id;
            $followupRequest = new Request($followupData);
            $this->followupRepository->create($followupRequest);
        }

        foreach ($request->discussions as $discussionData) {
            $discussionData['agenda_id'] = $agenda->id;
            $discussionRequest = new Request($discussionData);
            $this->discussionRepository->create($discussionRequest);
        }
        $agenda->save();
        return new AgendaResource($agenda);
    }

    public function updateAgenda(Request $request, Agenda $agenda, $meetingId)
    {
        Meeting::find($meetingId);
        return $agenda->update($request->all());
    }

    /**
     * @param Agenda $agenda
     * @param $meetingId
     * @return bool|null
     * @throws \Exception
     */
    public function deleteAgenda(Agenda $agenda, $meetingId)
    {
        Meeting::find($meetingId);
        return $agenda->delete($agenda);
    }
}