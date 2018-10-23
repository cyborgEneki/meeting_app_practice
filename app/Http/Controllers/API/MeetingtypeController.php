<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeetingtypeRequest;
use App\Meetingtype;
use App\Repositories\MeetingtypeRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeetingtypeController extends Controller
{
    protected $meetingtypeRepository;

    public function __construct(MeetingtypeRepositoryInterface $meetingtypeRepository)
    {
        $this->middleware(['role:admin']);
        $this->meetingtypeRepository = $meetingtypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetingtypes = $this->meetingtypeRepository->allMeetingtypes();

        return response()->json($meetingtypes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeetingtypeRequest $request)
    {
        $meetingtypes = $this->meetingtypeRepository->createMeetingtype($request);

        return response()->json($meetingtypes, 201);
    }

    public function show(Meetingtype $meetingtype)
    {
        return response()->json($meetingtype, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MeetingtypeRequest $request, Meetingtype $meetingtype)
    {
        $this->meetingtypeRepository->updateMeetingtype($request, $meetingtype);
        return response()->json(['You have successfully updated this meeting type.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meetingtype $meetingtype)
    {
        $this->meetingtypeRepository->deleteMeetingtype($meetingtype);
        return response()->json(['You have successfully deleted this meeting type.'],  200);
    }
}
