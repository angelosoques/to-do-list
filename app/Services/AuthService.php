<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService {

    public function login(array $loginData) 
    {
        if(Auth::attempt($loginData)) {
            $user = Auth::user();
            $user = User::with('tasks')->find($user->id);
            return $user;
        } else {
            return response()->json(['error' => 'failed attempt'], 500);
        }
    }
}