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

    public function getUser(Request $request)
    {

    }

    public function insertUser(Request $request) : JsonResource
    {
        $user = $this->userService->insertUserService($request);
        return new UserResource($user);
    }

    public function updateUser(Request $request)
    {
        // $result = UsersValidator::validateUpdateUser($request);

        // return new UserResource($result);
    }
}
