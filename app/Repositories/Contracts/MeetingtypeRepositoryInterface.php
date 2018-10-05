<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 9:00 PM
 */

namespace App\Repositories;

use App\Meetingtype;
use Illuminate\Http\Request;

interface MeetingtypeRepositoryInterface
{
    public function allMeetingtype();

    public function createMeetingtype(Request $request);

    public function updateMeetingtype(Request $request, Meetingtype $meetingtype);

    public function deleteMeetingtype(Meetingtype $meetingtype);
}