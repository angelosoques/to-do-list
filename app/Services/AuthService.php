<?php

namespace App\Services;

use App\Http\Resources\UserLoginResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthService {

    public function login(array $loginData) : JsonResponse | UserLoginResource
    {
        if(Auth::attempt($loginData)) {
            $user = Auth::user();
            $user = User::with(['tasks' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])->find($user->id);
            return new UserLoginResource($user);
        } else {
            return response()->json(['error' => 'failed attempt'], 500);
        }
    }

    public function checkLogin() : array | UserLoginResource {
        $user = Auth::user();
        if (!$user) {
            return [];
        }
        $user = User::with(['tasks' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->find($user->id);
        return new UserLoginResource($user);
    }
}