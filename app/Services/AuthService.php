<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService {

    public function login(array $loginData) 
    {
        if(Auth::attempt($loginData)) {
            $user = Auth::user();
            return ['id' => $user->id, 'email_address' => $user->email_address];
        } else {
            return response()->json(['error' => 'failed attempt'], 500);
        }
    }
}