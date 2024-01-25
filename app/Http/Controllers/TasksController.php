<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskShowRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Services\TasksServices;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    public $taskService;

    public function __construct(TasksServices $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request) : TaskResource
    {
        $response = $this->taskService->store($request->validated());

        return $response;
    }
        
    /**
     * Method update
     *
     * @param TaskUpdateRequest $request [explicite description]
     * @param $id $id [explicite description]
     *
     * @return TaskResource
     */
    public function update(TaskUpdateRequest $request, int $id) : TaskResource
    {
        $response = $this->taskService->update($request->validated(), $id);

        return $response;
    }
    
    /**
     * Method show
     *
     * @param TaskShowRequest $request [explicite description]
     *
     * @return array
     */
    public function show(TaskShowRequest $request) : array | TaskResourceCollection
    {
        $response = $this->taskService->show($request->validated());

        return $response;
    }
}
