<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\TaskListRequest;
use App\Models\Project;
use App\Models\TaskList;
use App\Repository\TaskListRepository;
use App\Service\TaskListService;

class TaskListController extends Controller
{
    public function __construct(
        private TaskListRepository $taskListRepository,
        private TaskListService $taskListService
    ) {}

    public function create(Project $project, TaskListRequest $request)
    {
        return $this->taskListService->create($request, $project);
    }

    public function delete(TaskList $taskList)
    {
        $this->taskListRepository->remove($taskList);
        return response()->json(['message' => 'Successfully']);
    }

    public function update(TaskListRequest $request, TaskList $taskList)
    {
        $this->taskListService->update($request, $taskList);
        return response()->json(['message' => 'Successfully']);
    }
}
