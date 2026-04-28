<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Services\TaskService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly TaskService $taskService)
    {
    }

    public function index(Project $project): JsonResponse
    {
        $this->authorize('view', $project);

        return $this->success([
            'tasks' => TaskResource::collection($this->taskService->listByProject($project))->resolve(),
        ]);
    }

    public function store(StoreTaskRequest $request, Project $project): JsonResponse
    {
        $this->authorize('update', $project);

        $task = $this->taskService->create($project, $request->validated());

        return $this->success([
            'task' => (new TaskResource($task))->resolve(),
        ], 'Task created successfully.', 201);
    }
}
