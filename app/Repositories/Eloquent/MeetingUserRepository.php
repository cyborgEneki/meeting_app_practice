<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:14 PM
 */

namespace App\Repositories;

use App\Meeting;
use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class MeetingUserRepository implements MeetingUserRepositoryInterface
{
    /**
     * @param Meeting $meeting
     * @param User $user
     * @return User
     * @throws \Exception
     */
    public function deleteMeetingUser(Meeting $meeting, User $user)
    {
        $user->meetings()->detach();
        return $user;
    }
}