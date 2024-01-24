<?php

namespace App\Http\Requests;

use App\Constants\TaskConstants;
use App\Rules\checkEnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaskCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'   => 'required|string|max:50',
            'status'  => ['required', 'string', new checkEnumValue(TaskConstants::class)],
            'user_id' => 'required|numeric|exists:users,id'
        ];
    }
}
