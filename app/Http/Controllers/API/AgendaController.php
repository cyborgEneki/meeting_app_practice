<?php

namespace App\Http\Controllers;

use App\Agenda;
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
        $agendas = $this->agendaRepository->allAgendas();

        return response()->json($agendas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        return response()->json($agenda, 200);
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
        $agendas = $this->agendaRepository->updateAgenda($request, $agenda);

        return response()->json($agendas, 200);
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