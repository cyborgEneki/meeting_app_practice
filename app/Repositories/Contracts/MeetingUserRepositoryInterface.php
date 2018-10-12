<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:10 PM
 */

namespace App\Repositories;

use App\User;
use App\Meeting;
use Illuminate\Http\Request;

interface MeetingUserRepositoryInterface
{
    public function deleteMeetingUser(Meeting $meeting, User $user);
}