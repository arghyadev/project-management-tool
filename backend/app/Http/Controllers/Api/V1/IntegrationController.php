<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\FinancialSyncService;
use App\Services\MeetingAutomationService;
use App\Services\TimesheetSyncService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Support\ApiResponse;

class IntegrationController extends Controller
{
    use ApiResponse;
    public function __construct(
        private readonly TimesheetSyncService $timesheetSyncService,
        private readonly FinancialSyncService $financialSyncService,
        private readonly MeetingAutomationService $meetingAutomationService,
    ) {
    }

    public function syncKeka(Request $request): JsonResponse
    {
        $data = $request->validate([
            'from_date' => ['required', 'date'],
            'to_date' => ['required', 'date', 'after_or_equal:from_date'],
        ]);

        return $this->success([
            'timesheets' => $this->timesheetSyncService->sync($data['from_date'], $data['to_date']),
        ], 'Keka sync completed.');
    }

    public function syncCrm(Request $request): JsonResponse
    {
        $data = $request->validate([
            'external_project_code' => ['required', 'string'],
        ]);

        return $this->success([
            'financials' => $this->financialSyncService->pullProjectFinancials($data['external_project_code']),
        ], 'CRM sync completed.');
    }

    public function calendarWebhook(Request $request): JsonResponse
    {
        $payload = $request->validate([
            'id' => ['required', 'integer'],
            'status' => ['required', 'string'],
        ]);

        $this->meetingAutomationService->processMeeting($payload);

        return $this->success([], 'Webhook accepted.', 202);
    }
}
