<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectAssignUserRequest;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserRole;
use Gate;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProjectController extends Controller
{
    public function getAll()
    {
        return Project::with(['users'])->get();
    }

    public function get(int $projectId)
    {
        return Project::find($projectId) ?? response()->json(['massage' => 'Not Found'], 404);
    }

    public function create(ProjectRequest $request)
    {
        $data = $request->validated();
        $project = Project::create($data);
        $project->assignUser(auth()->user());
        return $project;
    }

    public function update(int $projectId, ProjectRequest $request)
    {
        $data = $request->validated();
        $project = Project::find($projectId);
        Gate::authorize(UserPermission::PROJECT_UPDATE->name, $project);
        $project->fill($data);
        $project->save();
        return $project;
    }

    public function delete(int $projectId)
    {
        $project = Project::find($projectId);
        Gate::authorize(UserPermission::PROJECT_DELETE->name, $project);
        return $project->delete();
    }

    public function assignUser(ProjectAssignUserRequest $request)
    {
        $data = $request->validated();
        $project = Project::find($data['project_id']);
        $role = UserRole::from($data['role']);
        Gate::authorize(UserPermission::PROJECT_ASSIGN_USER->name, $project);
        return $project->assignUser(User::find($data['user_id']), $role);
    }
}
