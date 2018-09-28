<?php

namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 26/09/2018
 * Time: 10:57 PM
 */

use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingRepository implements MeetingRepositoryInterface
{
    public function createMeeting($request)
    {
        return Meeting::create($request->all());
    }

    public function updateMeeting(Request $request, Meeting $meeting)
    {
        return $meeting->update($request->all());
    }

    public function deleteMeeting(Meeting $meeting)
    {
        /** @var TYPE_NAME $meeting */
        return $meeting->delete();
    }
}