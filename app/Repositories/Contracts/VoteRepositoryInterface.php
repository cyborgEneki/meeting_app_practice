<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:10 PM
 */

namespace App\Repositories;

use App\Vote;
use App\Http\Requests\VoteRequest;
use App\Http\Requests\MeetingRequest;
use Illuminate\Http\Request;

interface VoteRepositoryInterface
{
    public function updateVote(VoteRequest $request, Vote $Vote);
    public function createVote(VoteRequest $request);
    public function deleteVote(Vote $Vote);
}