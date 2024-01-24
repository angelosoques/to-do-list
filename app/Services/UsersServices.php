<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Validators\UsersValidator;
use Illuminate\Support\Facades\Hash;

class UsersServices {

    public function getUserService(int $userId) : UserResource
    {
        $user = User::find($userId);

        return new UserResource($user);
    }

    public function insertUserService(Request $request) : array
    {
        $result = UsersValidator::validateInsertUser($request);

        $result['password'] = Hash::make($result['password']);

        $user = User::create($result);

        return ['userId' => $user->id, 'userEmail' => $user->email_address];
    }
}