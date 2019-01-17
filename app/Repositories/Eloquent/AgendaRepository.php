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
        if (!$request->abstain) {
            $agenda->uservotes()->attach(Auth::user()->id, ['vote'=>$request->vote]);
        }
        return;
    }

    public function relateAgenda(Request $request)
    {
        //if source and target are same, throw error
        if ($request->agendasource_id == $request->agendatarget_id) {
            abort(403, 'You cannot attach an agenda to itself.');
        }

        //only enter the smaller number first. this ensures no repeats
        if ($request->agendasource_id < $request->agendatarget_id) {
            $source_id = $request->agendasource_id;
            $target_id = $request->agendatarget_id;
        } else {
            $source_id = $request->agendatarget_id;
            $target_id = $request->agendasource_id;
        }

        //this makes method work for both relate and unrelate, we pass an action in the request
        $agendasource = Agenda::find($source_id);
        if ($request->action == 'relate') {
            $agendasource->agendaRelForward()->attach($target_id);
        } else {
            $agendasource->agendaRelForward()->detach($target_id);
        }
        return;
    }
}
