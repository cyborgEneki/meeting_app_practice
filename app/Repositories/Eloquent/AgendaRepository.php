<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:14 PM
 */

namespace App\Repositories;

use App\Agenda;
use App\Meeting;
use App\Http\Resources\AgendaResource;
use Illuminate\Http\Request;

class AgendaRepository implements AgendaRepositoryInterface
{
    public function allAgendas($meetingId)
    {
        Meeting::find($meetingId);
        return AgendaResource::collection(Agenda::all());
    }

    public function createAgenda(Request $request)
    {
        return Agenda::create($request->all());
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