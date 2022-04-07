<?php

namespace App\Service;

use App\Http\Requests\Project\TaskRequest;
use App\Models\Task;
use App\Repository\TaskRepository;

class TaskService
{
    public function __construct(
        private TaskRepository $taskRepository
    ) {}

    public function create(TaskRequest $request): Task
    {
        $task = new Task($request->validated());
        $this->taskRepository->add($task);
        return $task;
    }

    public function update(TaskRequest $request, Task $task): void
    {
        $task->fill($request->validated());
        $this->taskRepository->update($task);
    }
}
