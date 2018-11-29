<?php
/**
 * Created by PhpStorm.
 * User: jeneki
 * Date: 19/09/2018
 * Time: 11:48 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\CustomUserRepository;
use App\Repositories\CustomUserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    protected $customUserRepository;

    public $successStatus = 200;

    public function __construct(CustomUserRepositoryInterface $customUserRepositoryInterface, CustomUserRepository $customUserRepository)
    {
        $this->customUserRepository = $customUserRepository;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $users = $this->customUserRepository->allUsers();

        return $users;
    }

    public function update(UserRequest $request, User $user)
    {
        $this->customUserRepository->updateUser($request, $user);

        return response()->json(['You have successfully updated this user'], 200);
    }

    public function store(UserRequest $request)
    {
        $this->customUserRepository->createUser($request);

        return response()->json(['You have successfully created this user'], 201);
    }

    public function destroy($id)
    {
        $this->customUserRepository->deleteUser($id);

        return response()->json(['You have successfully deleted this user.'], 200);
    }
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['password_confirmation'] = bcrypt($input['password_confirmation']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['first_name'] = $user->first_name;
        $success['middle_name'] = $user->middle_name;
        $success['last_name'] = $user->last_name;
        $success['phone_number'] = $user->phone_number;

        return response()->json(['success' => $success], $this->successStatus);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}