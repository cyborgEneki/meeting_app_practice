<?php

namespace App\Repositories;


use App\Followup;
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

    public function createFollowup(Request $request);

    public function updateFollowup(Request $request, Followup $followup);

    public function deleteFollowup(Followup $followup);
}