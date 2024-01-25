<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService {
    
    /**
     * Method store
     *
     * @param array $data [explicite description]
     *
     * @return mixed
     */
    public function store(array $data) : UserResource
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        Auth::login($user);
        return new UserResource($user);
    }

}