<?php

namespace App\Repository;

use App\Models\AssignedUser;
use App\Models\Project;
use App\Models\User;

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

    /**
     * @return Project[]
     */
    public function findByUser(User $user): array
    {
        return AssignedUser::where(['user_id' => $user->id])
            ->with('project')
            ->get()
            ->map(function (AssignedUser $assignedUser) {
                return $assignedUser->project;
            })
            ->toArray();
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
