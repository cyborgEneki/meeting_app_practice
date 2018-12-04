<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 30/09/2018
 * Time: 6:59 PM
 */

namespace App\Repositories;

use App\User;
use App\Http\Requests\EditUserRequest;
use Illuminate\Http\Request;

interface CustomUserRepositoryInterface {
    public function allUsers();

    public function showUser($id);

//    public function createUser(UserRequest $request);

    public function updateUser(EditUserRequest $request, User $user);

    public function deleteUser($id);
}