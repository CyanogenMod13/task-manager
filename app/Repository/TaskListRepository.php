<?php

namespace App\Repository;

use App\Models\Project;
use App\Models\TaskList;

class TaskListRepository
{
    public function find(int $id): TaskList
    {
        return TaskList::findOrFail($id);
    }

    /**
     * @return TaskList[]
     */
    public function findAll(): array
    {
        return TaskList::all()->toArray();
    }

    /**
     * @return TaskList[]
     */
    public function findByProject(Project $project): array
    {
        return $project->lists()->get()->toArray();
    }

    public function add(TaskList $taskList): void
    {
        $taskList->saveOrFail();
    }

    public function update(TaskList $taskList): void
    {
        $taskList->updateOrFail();
    }

    public function remove(TaskList $taskList): void
    {
        $taskList->deleteOrFail();
    }
}
