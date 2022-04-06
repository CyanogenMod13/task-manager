<?php

namespace App\Service;

use App\Http\Requests\Project\ProjectRequest;
use App\Models\AssignedUser;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Repository\AssignedUserRepository;
use App\Repository\ProjectRepository;
use App\Repository\RoleRepository;
use DB;

class ProjectService
{
    public function __construct(
        private ProjectRepository $projectRepository,
        private AssignedUserRepository $assignedUserRepository,
        private RoleRepository $roleRepository
    ) {}

    public function create(ProjectRequest $request, User $user): Project
    {
        return DB::transaction(function() use ($user, $request) {
            $project = new Project();
            $project->name = $request->name;
            $this->projectRepository->add($project);
            $this->assignUser($project, $user, $this->roleRepository->findByType(Role::ADMIN_ROLE));
            return $project;
        });
    }

    public function assignUser(Project $project, User $user, Role $role): void
    {
        $assignedUser = new AssignedUser();
        $assignedUser->project_id = $project->id;
        $assignedUser->user_id = $user->id;
        $assignedUser->role_id = $role->id;
        $this->assignedUserRepository->add($assignedUser);
    }

    public function removeUser(Project $project, User $user): void
    {
        $assignUser = $this->assignedUserRepository->findByProjectAndUser($project, $user);
        $this->assignedUserRepository->remove($assignUser);
    }

    public function rename(Project $project, ProjectRequest $request): void
    {
        $project->name = $request->name;
        $this->projectRepository->update($project);
    }
}
