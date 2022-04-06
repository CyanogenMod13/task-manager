<?php

namespace App\Repository;

use App\Models\Project;

class ProjectRepository
{
    public function find(int $id): Project
    {
        return Project::findOrFail($id);
    }

    /**
     * @return Project[]
     */
    public function findAll(): array
    {
        return Project::all()->toArray();
    }

    public function add(Project $project): void
    {
        $project->saveOrFail();
    }

    public function update(Project $project): void
    {
        $project->updateOrFail();
    }

    public function remove(Project $project): void
    {
        $project->deleteOrFail();
    }
}
