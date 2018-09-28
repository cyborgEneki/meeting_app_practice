<?php

namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 26/09/2018
 * Time: 10:57 PM
 */

use App\Meeting;

class MeetingRepository implements MeetingRepositoryInterface
{
    public function createMeeting($request)
    {
        return Meeting::create($request->all());
    }
}