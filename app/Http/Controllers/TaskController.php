<?php

namespace App\Http\Controllers;

use App\Models\Manager\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repository\taskRepo;

class TaskController extends Controller
{
    public function __construct(public taskRepo $taskRepo)
    {
    }

    public function index()
    {
        return $this->taskRepo->index();
    }

    public function store(StoreTaskRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->taskRepo->create($request->only('title', 'body', 'amount', 'link'));
        return response()->json(['message' => 'success create task', 'status' => 'success'], 200);
    }


    public function show($task)
    {
        return $this->taskRepo->getFindId($task);
    }


    public function update(UpdateTaskRequest $request, $task)
    {
        //
    }


    public function destroy($task)
    {
        //
    }
}
