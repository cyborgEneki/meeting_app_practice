<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeetingRequest;
use App\Http\Requests\EditMeetingRequest;
use App\Media;
use App\Meeting;
use App\Meetingseries;
use App\Meetingtype;
use App\Repositories\MeetingRepository;
use App\User;
use App\Venue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MeetingRepositoryInterface;
use App\Events\MeetingAlert;

class MeetingController extends Controller
{
    protected $meetingRepository;

    public function __construct(MeetingRepositoryInterface $meetingRepositoryInterface, MeetingRepository $meetingRepository)
    {
        $this->meetingRepository = $meetingRepository;
    }

    public function index()
    {
        $meetings = $this->meetingRepository->allMeetings();

        return $meetings;
    }

    public function indexSimpleMeetings()
    {
        $meetings = $this->meetingRepository->allSimpleMeetings();
        return $meetings;
    }

    /**
     * @param Request $request
     * @param $meeting
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MeetingRequest $request)
    {
        $meeting = $this->meetingRepository->createMeeting($request);
        event(new MeetingAlert($meeting));
        return $meeting;
    }

    public function show($id)
    {
        $meetings = $this->meetingRepository->showMeeting($id);
        return $meetings;
    }

    /**
     * @param Request $request
     * @param Meeting $meeting
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Meeting $meeting)
    {
        $this->meetingRepository->updateMeeting($request, $meeting);
        return response()->json(['You have successfully updated your meeting.'], 200);
    }

    /**
     * @param Meeting $meeting
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->meetingRepository->deleteMeeting($id);
        return response()->json(['success' => 'You have successfully deleted your meeting.'], 200);
    }

//    public function attachUser($meetingId, $userId)
//    {
//        $this->meetingRepository->addUser($meetingId, $userId);
//        return response()->json(['success' => 'User added to meeting_user'], 200);
//    }

    public function attachUser(Request $request)
    {
        $this->meetingRepository->addUser($request->meeting_id, $request->user_id);
        return response()->json(['success' => 'User added to meeting_user'], 200);
    }

    public function detachUser($meetingId, $userId)
    {
        $this->meetingRepository->removeUser($meetingId, $userId);
        return response()->json(['success' => 'User deleted from meeting_user'], 200);
    }

    public function choices()
    {
        $users = User::all();
        $users = $users->keyBy('id');
        $users = ['users' => $users];

        $venues = Venue::take(10)->get();
        $venues = $venues->keyBy('id');
        $venues = ['venues' => $venues];

        $media = Media::take(10)->get();
        $media = $media->keyBy('id');
        $media = ['media' => $media];

        $meetingseries = Meetingseries::take(10)->get();
        $meetingseries = $meetingseries->keyBy('id');
        $meetingseries = ['meetingseries' => $meetingseries];

        $meetingtypes = Meetingtype::take(10)->get();
        $meetingtypes = $meetingtypes->keyBy('id');
        $meetingtypes = ['meetingtypes' => $meetingtypes];

        $choices = array_merge($users, $venues, $media, $meetingseries, $meetingtypes);
        return response()->json($choices, 200);

    }

    public function search(Request $request)
    {
        $meetings = Meeting::search($request->get('search'))->get();
        return response()->json($meetings, 200);
    }
}
