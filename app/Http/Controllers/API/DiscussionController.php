<?php

namespace App\Http\Controllers;
use App\Discussion;
use App\Agenda;
use App\Meeting;
use App\Http\Requests\DiscussionRequest;
use App\Repositories\DiscussionRepositoryInterface;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    protected $discussionRepository;

    public function __construct(DiscussionRepositoryInterface $discussionRepository)
    {
        $this->discussionRepository = $discussionRepository;
    }

    public function index()
    {
        $discussion = $this->discussionRepository->allDiscussions();
        return $discussion;
    }

    public function show($id)
    {
        $discussion = $this->discussionRepository->showDiscussion($id);
        return $discussion;
    }

    public function store(DiscussionRequest $request)
    {
        $agenda = Agenda::findOrFail($request->agenda_id);

        $meeting = Meeting::findOrFail($agenda->meeting_id);

        if($meeting->locked) {
            abort(403, "Meeting is locked.");
        }

        $discussion = $this->discussionRepository->createDiscussion($request);
        return $discussion;
    }

    public function update(DiscussionRequest $request, Discussion $discussion)
    {
        $agenda = Agenda::findOrFail($request->agenda_id);

        $meeting = Meeting::findOrFail($agenda->meeting_id);

        if($meeting->locked) {
            abort(403, "Meeting is locked.");
        }

        $this->discussionRepository->updateDiscussion($request, $discussion);
        return response()->json(['You have successfully updated your discussion.'], 200);
    }

    public function destroy(Discussion $discussion)
    {
        $agenda = Agenda::findOrFail($discussion->agenda_id);

        $meeting = Meeting::findOrFail($agenda->meeting_id);

        if($meeting->locked) {
            abort(403, "Meeting is locked.");
        }

        $this->discussionRepository->deleteDiscussion($discussion);
        return response()->json(['You have successfully deleted this discussion.'],  200);
    }
}