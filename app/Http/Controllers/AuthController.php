<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserLoginResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request) : JsonResponse | UserLoginResource
    {
        $user = $this->authService->login($request->validated());

        return $user;
    }

    public function checkLogin() : array | UserLoginResource
    {
        $user = $this->authService->checkLogin();

        return $user;
    }

    public function logout() : mixed
    {
        return Auth::logout();
    }
}
