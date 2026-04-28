<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SyncTimesheetRequest;
use App\Http\Resources\TimesheetResource;
use App\Services\TimesheetService;
use App\Services\TimesheetSyncService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly TimesheetService $timesheetService,
        private readonly TimesheetSyncService $timesheetSyncService,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->validate([
            'user_id' => ['nullable', 'integer'],
            'project_id' => ['nullable', 'integer'],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date'],
        ]);

        $timesheets = $this->timesheetService->list($filters);

        return $this->success([
            'timesheets' => TimesheetResource::collection($timesheets)->resolve(),
            'meta' => [
                'current_page' => $timesheets->currentPage(),
                'last_page' => $timesheets->lastPage(),
                'total' => $timesheets->total(),
            ],
        ]);
    }

    public function sync(SyncTimesheetRequest $request): JsonResponse
    {
        $data = $request->validated();
        $payload = $this->timesheetSyncService->sync($data['from_date'], $data['to_date']);
        $normalized = $payload['data'] ?? [];
        $this->timesheetService->syncFromKeka($normalized);

        return $this->success([], 'Timesheet sync completed.');
    }
}
