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

    public static function validateUpdateUser(Request $request) : array
    {
        return $request->validate(
            [
                'id'            => 'required|numeric|exists:users,id',
                'email_address' => 'sometimes|string|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/|unique:users,email_address,' . $request->input('id') . ',id',
                'password'      => 'required|string',
                'new_password'  => 'sometimes|string'
            ]
        );
    }
}