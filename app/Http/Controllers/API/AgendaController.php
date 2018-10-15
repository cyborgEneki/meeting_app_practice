<?php

namespace App\Http\Controllers;

use App\Agenda;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = $this->agendaRepository->allMeetingAgendas();

        return response()->json($agendas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agenda = $this->agendaRepository->createAgenda($request);

        return response()->json($agenda, 201);
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
    public function update(Request $request, Agenda $agenda)
    {
        $this->agendaRepository->updateAgenda($request, $agenda);
        return response()->json(['You have successfully updated your agenda.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        $agendas = $this->agendaRepository->deleteAgenda($agenda);

        return response()->json($agendas, 204);
    }
}
