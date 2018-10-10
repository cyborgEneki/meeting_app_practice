<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 9:00 PM
 */

namespace App\Repositories;

use App\Meetingseries;
use Illuminate\Http\Request;

interface MeetingseriesRepositoryInterface
{
    public function allMeetingseries();

    public function createMeetingseries(Request $request);

    public function updateMeetingseries(Request $request, Meetingseries $meetingseries);

    public function deleteMeetingseries(Meetingseries $meetingseries);
}