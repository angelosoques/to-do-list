<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Models\Task;

class TasksServices {

    public function store(array $taskData) : TaskResource
    {
        $task = Task::create($taskData);
        return new TaskResource($task);
    }

    public function update(array $taskData, int $id) : TaskResource
    {
        $task = Task::find($id);

        $task->title = $taskData['title'] ?? $task->title;
        $task->status = $taskData['first_name'] ?? $task->status;
        $task->save();

        return new TaskResource($task);
    }
}