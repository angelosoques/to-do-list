<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
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
        $task->status = $taskData['status'] ?? $task->status;
        $task->save();

        return new TaskResource($task);
    }

    public function show(array $taskData) : array | TaskResourceCollection
    {
        $task = Task::where('title', 'LIKE', '%' . $taskData['title'] . '%')
                    ->where('status', '!=', 'deleted')
                    ->where('user_id', '=', $taskData['user_id'])->get();
        
        if ($task) {
            return new TaskResourceCollection($task);
        } 

        return [];
    }
}