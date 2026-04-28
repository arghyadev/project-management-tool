<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectMemberRequest;
use App\Http\Requests\UpdateProjectMemberRequest;
use App\Http\Resources\ProjectMemberResource;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Services\ResourceAllocationService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class ResourceAllocationController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly ResourceAllocationService $resourceAllocationService)
    {
    }

    public function index(Project $project): JsonResponse
    {
        $this->authorize('view', $project);

        return $this->success([
            'members' => ProjectMemberResource::collection(
                $this->resourceAllocationService->listMembers($project->id)
            )->resolve(),
        ]);
    }

    public function store(StoreProjectMemberRequest $request, Project $project): JsonResponse
    {
        $this->authorize('update', $project);

        $member = $this->resourceAllocationService->addMember($project->id, $request->validated());

        return $this->success([
            'member' => (new ProjectMemberResource($member))->resolve(),
        ], 'Project member allocation saved.', 201);
    }

    public function update(UpdateProjectMemberRequest $request, ProjectMember $projectMember): JsonResponse
    {
        $member = $this->resourceAllocationService->updateMember($projectMember, $request->validated());

        return $this->success([
            'member' => (new ProjectMemberResource($member))->resolve(),
        ], 'Project member allocation updated.');
    }
}
