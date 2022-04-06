<?php

namespace App\Service;

use App\Http\Requests\Project\TaskListRequest;
use App\Models\Project;
use App\Models\TaskList;
use App\Repository\TaskListRepository;

class TaskListService
{
    public function __construct(
        private TaskListRepository $taskListRepository
    ) {}

    public function create(TaskListRequest $request, Project $project): TaskList
    {
        $taskList = new TaskList();
        $taskList->name = $request->name;
        $taskList->project_id = $project->id;
        $this->taskListRepository->add($taskList);
        return $taskList;
    }

    public function update(TaskListRequest $request, TaskList $taskList): void
    {
        $taskList->name = $request->name;
        $this->taskListRepository->update($taskList);
    }
}
