<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SyncFinancialRequest;
use App\Http\Resources\FinancialSnapshotResource;
use App\Models\Project;
use App\Services\FinancialSnapshotService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class FinancialController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly FinancialSnapshotService $financialSnapshotService)
    {
    }

    public function index(Project $project): JsonResponse
    {
        $this->authorize('view', $project);

        return $this->success([
            'financials' => FinancialSnapshotResource::collection(
                $this->financialSnapshotService->listByProject($project->id)
            )->resolve(),
        ]);
    }

    public function sync(SyncFinancialRequest $request, Project $project): JsonResponse
    {
        $this->authorize('update', $project);
        $snapshot = $this->financialSnapshotService->syncProject($project->id, $request->validated('external_project_code'));

        return $this->success([
            'financial' => (new FinancialSnapshotResource($snapshot))->resolve(),
        ], 'Financial snapshot synced.', 201);
    }
}
