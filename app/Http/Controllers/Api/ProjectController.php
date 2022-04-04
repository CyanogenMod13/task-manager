<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project;
use Gate;

class ProjectController extends Controller
{
    public function getAll()
    {
        return Project::all();
    }

    public function get(int $projectId)
    {
        $project = Project::with('lists.tasks')->find($projectId);
        if (!$project) {
            return response()->json(['massage' => 'Project not found'], 404);
        }
        return $project;
    }

    public function create(ProjectRequest $request)
    {
        $data = $request->validated();
        $project = Project::create($data);
        $project->assignUser(auth()->user()->id, true);
        return $project;
    }

    public function update(int $project_id, ProjectRequest $request)
    {
        if (!Gate::allows('configure-project', $project_id)) {
            abort(403);
        }
        $data = $request->validated();
        $project = Project::find($project_id);
        if ($project) {
            if ($project->fill($data)->save()) {
                return response()->json(['message' => 'Successfully']);
            } else {
                response()->json(['message' => 'Cannot change project'], 500);
            }
        }
        return response()->json(['massage' => 'Project not found'], 404);
    }

    public function delete(int $project_id)
    {
        if (!Gate::allows('configure-project', $project_id)) {
            abort(403);
        }
        $project = Project::find($project_id);
        if ($project) {
            if ($project->delete()) {
                return response()->json(['message' => 'Successfully']);
            } else {
                return response()->json(['message' => 'Cannot delete project'], 500);
            }
        }
        return response()->json(['massage' => 'Project not found'], 404);
    }
}
