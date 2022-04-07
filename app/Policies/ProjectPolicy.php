<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use App\Repository\AssignedUserRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function __construct(
        private AssignedUserRepository $repository
    ) {}

    public function configure(User $user, Project $project): bool
    {
        return $this->repository->findByProjectAndUser($project, $user)->isAdmin();
    }
}
