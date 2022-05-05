<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\TaskRequest;
use App\Models\Task;
use App\Repository\TaskRepository;
use App\Service\TaskService;

class TaskController extends Controller
{
    public function __construct(
        private TaskService    $taskService,
        private TaskRepository $taskRepository
    ) {}

    public function show(Task $task)
    {
        return $task;
    }

    public function create(TaskRequest $request)
    {
        return $this->taskService->create($request);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->taskService->update($request, $task);
        return response()->json(['message' => 'Successfully']);
    }

    public function delete(Task $task)
    {
        $this->taskRepository->remove($task);
        return response()->json(['message' => 'Successfully']);
    }
}
