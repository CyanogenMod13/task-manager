<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use App\Service\ProjectService;
use Gate;

class AssignUserController extends Controller
{
    public function __construct(
        private ProjectService $projectService
    ) {}

    public function assignUser(Project $project, User $user, Role $role)
    {
        if (!Gate::allows('configure-project', $project)) {
            abort(403);
        }
        $this->projectService->assignUser($project, $user, $role);
        return response()->json(['message' => 'Successfully']);
    }

    public function removeUser(Project $project, User $user)
    {
        if (!Gate::allows('configure-project', $project)) {
            abort(403);
        }
        $this->projectService->removeUser($project, $user);
        return response()->json(['message' => 'Successfully']);
    }
}
