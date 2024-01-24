<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $userData = $this->userService->getUserService($userId);
        return $userData;
    }

    public function insertUser(Request $request) : array
    {
        $userData = $this->userService->insertUserService($request);
        return $userData;
    }
}
