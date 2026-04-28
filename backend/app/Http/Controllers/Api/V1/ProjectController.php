<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly ProjectService $projectService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $projects = $this->projectService->listForUser((int) $request->user()->id);

        return $this->success([
            'projects' => ProjectResource::collection($projects)->resolve(),
            'meta' => [
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'per_page' => $projects->perPage(),
                'total' => $projects->total(),
            ],
        ]);
    }

    public function store(StoreProjectRequest $request): JsonResponse
    {
        $project = $this->projectService->create($request->validated(), (int) $request->user()->id);

        return $this->success([
            'project' => (new ProjectResource($project))->resolve(),
        ], 'Project created successfully.', 201);
    }

    public function show(Project $project): JsonResponse
    {
        $this->authorize('view', $project);

        return $this->success([
            'project' => (new ProjectResource($project))->resolve(),
        ]);
    }

    public function update(StoreProjectRequest $request, Project $project): JsonResponse
    {
        $this->authorize('update', $project);
        $project = $this->projectService->update($project, $request->validated());

        return $this->success([
            'project' => (new ProjectResource($project))->resolve(),
        ], 'Project updated successfully.');
    }

    public function destroy(Project $project): Response
    {
        $this->authorize('delete', $project);
        $this->projectService->delete($project);

        return response()->noContent();
    }
}
