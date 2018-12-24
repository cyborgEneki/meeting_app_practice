<?php

namespace App\Http\Controllers;
use App\Discussion;
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
        $discussion = $this->discussionRepository->createDiscussion($request);
        return $discussion;
    }

    public function update(DiscussionRequest $request, Discussion $discussion)
    {
        $this->discussionRepository->updateDiscussion($request, $discussion);
        return response()->json(['You have successfully updated your discussion.'], 200);
    }

    public function destroy(Discussion $discussion)
    {
        $this->discussionRepository->deleteDiscussion($discussion);
        return response()->json(['You have successfully deleted this discussion.'],  200);
    }
}