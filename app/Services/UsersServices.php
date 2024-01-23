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

    public function insertUserService(Request $request) : int
    {
        $result = UsersValidator::validateInsertUser($request);

        $result['password'] = Hash::make($result['password']);

        $user = User::create($result);

        return $user->id;
    }

    public function updateUserService(Request $request) 
    {
        $result = UsersValidator::validateUpdateUser($request);

        $user = User::find($result['id']);

        if (!Hash::check($result['password'], $user['password'])) {
            return ["error" => "wrong password"];
        }

        $user->update($result);
    }
}