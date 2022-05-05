<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\Project;
use App\Repository\ProjectRepository;
use App\Service\ProjectService;
use Auth;
use Gate;

class ProjectController extends Controller
{
    public function __construct(
        private ProjectService $projectService,
        private ProjectRepository $projectRepository
    ) {}

    public function index()
    {
        $projects = $this->projectRepository->findByUser(Auth::user());
        $result = [];
        foreach ($projects as $project) {
            $result[] = ['id' => $project['id'], 'name' => $project['name']];
        }
        return ['projects' => $result];
    }

    public function show(Project $project)
    {
        return $project;
    }

    public function create(ProjectRequest $request)
    {
        return $this->projectService->create($request, Auth::user());
    }

    public function update(Project $project, ProjectRequest $request)
    {
        if (!Gate::allows('configure-project', $project)) {
            abort(403);
        }
        $this->projectService->rename($project, $request);
        return response()->json(['message' => 'Successfully']);
    }

    public function delete(Project $project)
    {
        if (!Gate::allows('configure-project', $project)) {
            abort(403);
        }
        $this->projectRepository->remove($project);
        return response()->json(['message' => 'Successfully']);
    }
}
