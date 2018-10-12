<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 19/09/2018
 * Time: 11:48 PM
 */

namespace App\Http\Controllers;

use App\Meeting;
use App\Repositories\MeetingUserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\User;

class MeetingUserController extends Controller
{
    protected $meetingUserRepository;

    public function __construct(MeetingUserRepositoryInterface $meetingUserRepository)
    {
        $this->meetingUserRepository = $meetingUserRepository;
    }

    public function destroy(Meeting $meeting, User $user)
    {
        $this->meetingUserRepository->deleteMeetingUser($meeting, $user);
        return response()->json(['success' => 'User deleted from meeting_user'], 200);
    }
}