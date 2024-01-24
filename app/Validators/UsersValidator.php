<?php

namespace App\Validators;

use Illuminate\Http\Request;

class UsersValidator {

    public static function validateInsertUser(Request $request) : array
    {
        return $request->validate(
            [
                'email_address' => 'required|string|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|unique:users,email_address',
                'password'      => 'required|string',
            ]
        );
    }
}