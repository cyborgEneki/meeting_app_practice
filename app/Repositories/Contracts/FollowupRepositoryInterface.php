<?php

namespace App\Repositories;


use App\Followup;
use App\Http\Requests\FollowupRequest;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 01/10/2018
 * Time: 8:53 PM
 */

interface FollowupRepositoryInterface
{
    public function allFollowups();

    public function createFollowup(FollowupRequest $request);

    public function updateFollowup(FollowupRequest $request, Followup $followup);

    public function deleteFollowup(Followup $followup);
}