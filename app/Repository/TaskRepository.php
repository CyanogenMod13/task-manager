<?php

namespace App\Repository;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskList;

class TaskRepository
{
    public function find(int $id): Task
    {
        return Task::findOrFail($id);
    }

    /**
     * @return Task[]
     */
    public function findAll(): array
    {
        return Task::all()->toArray();
    }

    /**
     * @return Task[]
     */
    public function findByTaskList(TaskList $taskList): array
    {
        return $taskList->tasks()->get()->toArray();
    }

    /**
     * @return Task[]
     */
    public function findByProject(Project $project): array
    {
        return [];
    }

    public function add(Task $task): void
    {
        $task->saveOrFail();
    }

    public function update(Task $task): void
    {
        $task->updateOrFail();
    }

    public function remove(Task $task): void
    {
        $task->deleteOrFail();
    }
}
