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
use Illuminate\Support\Facades\Auth;

class AgendaRepository implements AgendaRepositoryInterface
{
    public function createAgenda(AgendaRequest $request)
    {
        $agenda = Agenda::create($request->all());
        return new AgendaResource($agenda);
    }
    public function updateAgenda(AgendaRequest $request, Agenda $agenda)
    {
        $agenda = $agenda->update($request->all());
        return new AgendaResource($agenda);
    }

    /**
     * @param Agenda $agenda
     * @return bool|null
     * @throws \Exception
     */
    public function deleteAgenda(Agenda $agenda)
    {
        return $agenda->delete($agenda);
    }

    public function vote(Request $request)
    {
        $agenda = Agenda::find($request->agenda_id);
        $agenda->uservotes()->detach(Auth::user()->id);
        $agenda->uservotes()->attach(Auth::user()->id, ['vote'=>$request->vote]);
        return;
    }
}