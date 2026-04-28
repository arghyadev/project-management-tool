<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Services\TaskService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    public function __construct(private readonly TaskService $taskService)
    {
    }

    public function index(Project $project): AnonymousResourceCollection
    {
        $this->authorize('view', $project);

        return TaskResource::collection($this->taskService->listByProject($project));
    }

    public function store(StoreTaskRequest $request, Project $project): TaskResource
    {
        $this->authorize('update', $project);

        $task = $this->taskService->create($project, $request->validated());

        return new TaskResource($task);
    }
}
