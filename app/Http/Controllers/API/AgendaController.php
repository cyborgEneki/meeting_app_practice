<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Http\Requests\AgendaRequest;
use App\Http\Resources\AgendaResource;
use App\Repositories\AgendaRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
    protected $agendaRepository;

    public function __construct(AgendaRepositoryInterface $agendaRepository)
    {
        $this->agendaRepository = $agendaRepository;
    }
    /**
     * Display the specified resource.
     *
     * @param Agenda $agenda
     * @return AgendaResource
     */
//    public function show($meetingId, $agendaId)
//    {
//        $agenda = Agenda::with('meeting')->where('meeting_id', $meetingId)->find('id', $agendaId);
//        return response()->json($agenda, 200);
//    }

    public function store(AgendaRequest $request)
    {
        $agenda = $this->agendaRepository->createAgenda($request);

        return response()->json($agenda, 201);
    }
    public function show($id)
    {
        $agenda = Agenda::find($id);
        return new AgendaResource($agenda);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(AgendaRequest $request, Agenda $agenda)
    {
        $this->agendaRepository->updateAgenda($request, $agenda);
        return response()->json(['You have successfully updated your agenda.'], 200);
    }

    public function vote(Request $request)
    {
        return $this->agendaRepository->vote($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        $this->agendaRepository->deleteAgenda($agenda);
        return response()->json(['You have successfully deleted your agenda.'],  200);
    }

    public function relate(Request $request) 
    {
        $this->agendaRepository->relateAgenda($request);
        return response()->json(['You have successfully linked your agenda.'], 200);
    }
}
