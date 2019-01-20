<?php

namespace App\Http\Controllers;

use App\Followup;
use App\Http\Requests\FollowupRequest;
use App\Repositories\FollowupRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowupController extends Controller
{
    protected $followupRepository;

    public function __construct(FollowupRepositoryInterface $followupRepository)
    {
        $this->followupRepository = $followupRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $followups = $this->followupRepository->allFollowups();

        return response()->json($followups, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FollowupRequest $request)
    {
        $agenda = Agenda::findOrFail($request->agenda_id);

        $meeting = Meeting::findOrFail($agenda->meeting_id);

        if($meeting->locked) {
            abort(403, "Meeting is locked.");
        }
        
        $followups = $this->followupRepository->createFollowup($request);

        return response()->json($followups, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Followup  $followup
     * @return \Illuminate\Http\Response
     */
    public function show(Followup $followup)
    {
        return response()->json($followup, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Followup  $followup
     * @return \Illuminate\Http\Response
     */
    public function update(FollowupRequest $request, Followup $followup)
    {
        $agenda = Agenda::findOrFail($request->agenda_id);

        $meeting = Meeting::findOrFail($agenda->meeting_id);

        if($meeting->locked) {
            abort(403, "Meeting is locked.");
        }

        $this->followupRepository->updateFollowup($request, $followup);
        return response()->json(['You have successfully updated your followup.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Followup  $followup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Followup $followup)
    {
        $agenda = Agenda::findOrFail($followup->agenda_id);

        $meeting = Meeting::findOrFail($agenda->meeting_id);

        if($meeting->locked) {
            abort(403, "Meeting is locked.");
        }

        $this->followupRepository->deleteFollowup($followup);
        return response()->json(['You have successfully deleted the followup.'],  200);
    }
}