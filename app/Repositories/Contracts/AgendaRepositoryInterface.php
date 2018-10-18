<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:10 PM
 */

namespace App\Repositories;

use App\Agenda;
use App\Http\Requests\AgendaRequest;
use Illuminate\Http\Request;

interface AgendaRepositoryInterface
{
    public function updateAgenda(AgendaRequest $request, Agenda $agenda);
    public function createAgenda(AgendaRequest $request);

    public function deleteAgenda(Agenda $agenda);
}