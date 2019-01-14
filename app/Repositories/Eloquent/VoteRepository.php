<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:14 PM
 */

namespace App\Repositories;

use App\Vote;
use App\Http\Requests\VoteRequest;
use App\Meeting;
use App\Http\Resources\VoteResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteRepository implements VoteRepositoryInterface
{
    public function createVote(VoteRequest $request)
    {
        $Vote = Vote::create($request->all());
        return new VoteResource($Vote);
    }
    public function updateVote(VoteRequest $request, Vote $Vote)
    {
        $Vote = $Vote->update($request->all());
        return new VoteResource($Vote);
    }

    /**
     * @param Vote $Vote
     * @param $meetingId
     * @return bool|null
     * @throws \Exception
     */
    public function deleteVote(Vote $Vote)
    {
        return $Vote->delete($Vote);
    }

}