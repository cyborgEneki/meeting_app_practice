<?php

namespace App\Repositories;

use App\Followup;
use App\Http\Resources\FollowupResource;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 01/10/2018
 * Time: 8:58 PM
 */

class FollowupRepository implements FollowupRepositoryInterface
{
    public function allFollowups()
    {
        return FollowupResource::collection(Followup::all());
    }

    public function createFollowup(Request $request)
    {
        return Followup::create($request->all());
    }

    public function updateFollowup(Request $request, Followup $followup)
    {
        return $followup->update($request->all());
    }


    /**
     * @param Followup $followup
     * @return bool|null
     * @throws \Exception
     */
    public function deleteFollowup(Followup $followup)
    {
        return $followup->delete($followup);
    }
}