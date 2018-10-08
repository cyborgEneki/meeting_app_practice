<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:14 PM
 */

namespace App\Repositories;

use App\Discussion;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\DiscussionResource;
use Illuminate\Http\Request;

class DiscussionRepository implements DiscussionRepositoryInterface
{
    public function allDiscussions()
    {
        return DiscussionResource::collection(Discussion::all());
    }

    public function createDiscussion(Request $request)
    {
        return Discussion::create($request->all());
    }

    public function updateDiscussion(Request $request, Discussion $discussion)
    {
        return $discussion->update($request->all());
    }

    /**
     * @param Note $note
     * @return bool|null
     * @throws \Exception
     */
    public function deleteDiscussion(Discussion $discussion)
    {
        return $discussion->delete($discussion);
    }
}