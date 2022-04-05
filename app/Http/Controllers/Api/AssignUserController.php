<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Gate;

class AssignUserController extends Controller
{
    public function assignUser(Project $project, User $user, Role $role)
    {
        if (!Gate::allows('configure-project', $project)) {
            abort(403);
        }
        return $project->assignUser($user, $role);
    }

    public function removeUser(Project $project, User $user)
    {
        if (!Gate::allows('configure-project', $project)) {
            abort(403);
        }
        if ($project->removeUser($user)) {
            return response()->json(['message' => 'Successfully']);
        } else {
            return response()->json(['message' => 'Cannot remove user: internal error'], 500);
        }
    }
}
