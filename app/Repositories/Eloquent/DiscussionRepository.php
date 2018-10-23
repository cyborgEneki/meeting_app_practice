<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:14 PM
 */

namespace App\Repositories;

use App\Discussion;
use App\Http\Requests\DiscussionRequest;
use App\Http\Resources\DiscussionResource;
use Illuminate\Http\Request;

class DiscussionRepository implements DiscussionRepositoryInterface
{
    public function allDiscussions()
    {
        return DiscussionResource::collection(Discussion::all());
    }

    public function showDiscussion($id)
    {
        $discussion = Discussion::findOrFail($id);
        return new DiscussionResource($discussion);
    }

    public function createDiscussion(DiscussionRequest $request)
    {
        $discussion = Discussion::create($request->all());
        return new DiscussionResource($discussion);
    }

    public function updateDiscussion(DiscussionRequest $request, Discussion $discussion)
    {
        $discussion = $discussion->update($request->all());
        return new DiscussionResource($discussion);
    }

    /**
     * @param Discussion $discussion
     * @return bool|null
     * @throws \Exception
     */
    public function deleteDiscussion(Discussion $discussion)
    {
        return $discussion->delete($discussion);
    }
}