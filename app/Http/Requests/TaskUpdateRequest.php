<?php

namespace App\Http\Requests;

use App\Constants\TaskConstants;
use App\Models\Task;
use App\Rules\checkEnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $taskId = $this->route('taskId');
        $task = Task::find($taskId);
        return $task = Auth::user()->id === $task->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|string|max:50',
            'status' => ['required', 'string', new checkEnumValue(TaskConstants::class)]
        ];
    }
}
