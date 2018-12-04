<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 10:14 PM
 */

namespace App\Repositories;

use App\User;
use App\Http\Requests\EditUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class CustomUserRepository implements CustomUserRepositoryInterface
{
    public function allUsers()
    {
//        return UserResource::collection(User::all());
        return UserResource::collection(User::take(10)->get());
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    public function createUser(UserRequest $request)
    {
        $user = User::create($request->all());

        return new UserResource($user);
    }

    public function updateUser(EditUserRequest $request, User $user)
    {
        $user = $user->update($request->all());

        return new UserResource($user);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        return $user->delete($user);
    }
}