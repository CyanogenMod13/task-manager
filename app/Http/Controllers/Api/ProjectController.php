<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Gate;

class ProjectController extends Controller
{
    public function getAll()
    {
        return Project::all();
    }

    public function get(Project $project)
    {
        return $project;
    }

    public function create(ProjectRequest $request, User $user)
    {
        $project = Project::create($request->validated());
        $project->assignUser($user, Role::where(['type' => Role::ADMIN_ROLE]));
        return $project;
    }

    /**
     * @throws \Throwable
     */
    public function update(Project $project, ProjectRequest $request)
    {
        if (!Gate::allows('configure-project', $project)) {
            abort(403);
        }
        if ($project->updateOrFail($request->validated())) {
            return response()->json(['message' => 'Successfully']);
        }
    }

    /**
     * @throws \Throwable
     */
    public function delete(Project $project)
    {
        if (!Gate::allows('configure-project', $project)) {
            abort(403);
        }
        if ($project->deleteOrFail()) {
            return response()->json(['message' => 'Successfully']);
        }
    }
}
