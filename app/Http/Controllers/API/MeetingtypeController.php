<?php

namespace App\Http\Controllers;

use App\Meetingtype;
use App\Repositories\MeetingtypeRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeetingtypeController extends Controller
{
    protected $meetingtypeRepository;

    public function __construct(MeetingtypeRepositoryInterface $meetingtypeRepository)
    {
        $this->meetingtypeRepository = $meetingtypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetingtypes = $this->meetingtypeRepository->allMeetingtype();

        return response()->json($meetingtypes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
    public function update(Request $request, Meetingtype $meetingtype)
    {
        $meetingtypes = $this->meetingtypeRepository->updateMeetingtype($request, $meetingtype);

        return response()->json($meetingtypes, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meetingtype $meetingtype)
    {
        $meetingtypes = $this->meetingtypeRepository->deleteMeetingtype($meetingtype);

        return response()->json($meetingtypes, 204);
    }
}
