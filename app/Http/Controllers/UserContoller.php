<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserContoller extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function store(UserCreateRequest $request) : UserResource
    {
        $returnData = $this->userService->store($request->validated());

        return new UserResource($returnData);
    }
}
