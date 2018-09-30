<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:14 PM
 */

namespace App\Repositories;

use App\Agenda;
use App\Http\Resources\AgendaResource;
use Illuminate\Http\Request;

class AgendaRepository implements AgendaRepositoryInterface
{
    public function allAgendas()
    {
        return AgendaResource::collection(Agenda::all());
    }

    public function createAgenda(Request $request)
    {
        return Agenda::create($request->all());
    }

    public function updateAgenda(Request $request, Agenda $agenda)
    {
        return $agenda->update($request->all());
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
}