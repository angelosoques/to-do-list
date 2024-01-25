<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskShowRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'   => 'required|string|max:50',
            'user_id' => 'required|numeric|exists:users,id|exists:tasks,user_id'
        ];
    }
}
