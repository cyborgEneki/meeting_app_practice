<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeetingRequest;
use App\Http\Requests\EditMeetingRequest;
use App\Media;
use App\Agenda;
use App\Discussion;
use App\Followup;
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
use App\Notifications\MeetingCanceled;
use Illuminate\Support\Facades\Mail;

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
        if (!($request->exists('date'))) {
            if(!($meeting->date == $request->date)) {
                Mail::to($request->users())->send(new AlertMail($meeting));
            }
        }

        //meeting is locked
        if ($meeting->locked) {
            //this is not admin so throw exception
            if (Auth::user()->access<>1) {
                abort(403, 'Meeting is locked');
            }

            //this is admin but they are not trying to unlock
            if (!($request->exists('locked') && $request->locked == 0)) {
                abort(403, 'Meeting is locked');
            }
        }

        //this is not the meeting creator and not an admin - deny permission to edit anything
        if ($meeting->creator_id <> Auth::User()->id && Auth::User()->access <> 1) {
            abort(403, 'Permission denied');
        }

        $this->meetingRepository->updateMeeting($request, $meeting);
        return response()->json(['You have successfully updated your meeting.'], 200);
    }

    public function lock(Request $request, Meeting $meeting)
    {
        //drop everything other than locked
        //Loop through the request object and drop any field that’s not locked
        $meeting = Meeting::findOrFail($request->meeting_id);
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
        Mail::to($request->users())->send(new AlertMail($meeting));
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

        $agendas = Agenda::take(10)->get();
        $agendas = $agendas->keyBy('id');
        $agendas = ['agendas' => $agendas];

        $choices = array_merge($users, $venues, $media, $meetingseries, $meetingtypes, $agendas);
        return response()->json($choices, 200);
    }

    public function search(Request $request)
    {
        $meetings = Meeting::search($request->get('search'))->get();
        $meetings = ['meetings' => $meetings];

        $agendas = Agenda::search($request->get('search'))->get();
        $agendas = ['agendas' => $agendas];

        $discussions = Discussion::search($request->get('search'))->get();
        $discussions = ['discussions' => $discussions];

        $followups = Followup::search($request->get('search'))->get();
        $followups = ['followups' => $followups];

        $results = array_merge($meetings, $agendas, $discussions, $followups);
        return response()->json($results, 200);
    }
}
