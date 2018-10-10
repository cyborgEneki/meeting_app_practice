<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:10 PM
 */

namespace App\Repositories;

use App\Agenda;
use Illuminate\Http\Request;

interface AgendaRepositoryInterface
{
    public function allMeetingAgendas();

    public function createAgenda(Request $request);

    public function updateAgenda(Request $request, Agenda $agenda);

    public function deleteAgenda(Agenda $agenda);
}