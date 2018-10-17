<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:14 PM
 */

namespace App\Repositories;

use App\Agenda;
use App\Http\Requests\AgendaRequest;
use App\Meeting;
use App\Http\Resources\AgendaResource;
use Illuminate\Http\Request;

class AgendaRepository implements AgendaRepositoryInterface
{
    public function updateAgenda(AgendaRequest $request, Agenda $agenda)
    {
        $agenda = $agenda->update($request->all());
        return new AgendaResource($agenda);
    }

    /**
     * @param Agenda $agenda
     * @param $meetingId
     * @return bool|null
     * @throws \Exception
     */
    public function deleteAgenda(Agenda $agenda)
    {
        return $agenda->delete($agenda);
    }
}