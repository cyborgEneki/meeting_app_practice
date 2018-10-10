<?php

namespace App\Http\Controllers;

use App\Meetingseries;
use App\Repositories\MeetingseriesRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeetingseriesController extends Controller
{
    protected $meetingseriesRepository;

    public function __construct(MeetingseriesRepositoryInterface $meetingseriesRepository)
    {
        $this->meetingseriesRepository = $meetingseriesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetingseries = $this->meetingseriesRepository->allMeetingseries();

        return $meetingseries;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $meetingseries = $this->meetingseriesRepository->createMeetingseries($request);

        return $meetingseries;
    }

    public function show(Meetingseries $meetingseries)
    {
        return $meetingseries;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meetingseries $meetingseries)
    {
        $meetingseries = $this->meetingseriesRepository->updateMeetingseries($request, $meetingseries);

        return $meetingseries;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Meetingseries $meetingseries
     * @return Meetingseries
     */
    public function destroy(Meetingseries $meetingseries)
    {
        $meetingseries = $this->meetingseriesRepository->deleteMeetingseries($meetingseries);

        return $meetingseries;
    }
}
