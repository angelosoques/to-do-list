<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Services\UsersServices;

class UsersController extends Controller
{
    public $userService;

    public function __construct(UsersServices $userService)
    {
        $this->userService = $userService;
    }

    public function getUser(int $userId)
    {
        return $this->userService->getUserService($userId);
    }

    public function insertUser(Request $request)
    {
        $userId = $this->userService->insertUserService($request);
        return redirect()->route('/dashboard/' . $userId)->with('Success', 'User created successfully');
    }

    public function updateUser(Request $request)
    {
        // $result = UsersValidator::validateUpdateUser($request);

        // return new UserResource($result);
    }
}
