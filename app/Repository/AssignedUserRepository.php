<?php

namespace App\Repository;

use App\Models\AssignedUser;
use App\Models\Project;
use App\Models\User;

class AssignedUserRepository
{
    public function find(int $id): AssignedUser
    {
        return AssignedUser::findOrFail($id);
    }

    /**
     * @return AssignedUser[]
     */
    public function findAll(): array
    {
        return AssignedUser::all()->toArray();
    }

    public function findByProjectAndUser(Project $project, User $user): AssignedUser
    {
        return AssignedUser::where(['project_id' => $project->id, 'user_id' => $user->id])
            ->with('role')
            ->firstOrFail();
    }

    public function add(AssignedUser $assignedUser): void
    {
        $assignedUser->push();
    }

    public function update(AssignedUser $assignedUser): void
    {
        $assignedUser->updateOrFail();
    }

    public function remove(AssignedUser $assignedUser): void
    {
        $assignedUser->deleteOrFail();
    }
}
