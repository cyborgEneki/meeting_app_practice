<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;

class AgendaMeetingController extends Controller
{
    public function index ($meetingId)
    {
        $meeting = Meeting::find($meetingId); 
        return $meeting->agendas;
    }
}
