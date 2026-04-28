<?php

namespace App\Services;

use App\Repositories\Contracts\FinancialSnapshotRepositoryInterface;
use Illuminate\Support\Collection;

class FinancialSnapshotService
{
    public function __construct(
        private readonly FinancialSnapshotRepositoryInterface $financialSnapshotRepository,
        private readonly FinancialSyncService $financialSyncService,
    ) {
    }

    public function listByProject(int $projectId): Collection
    {
        return $this->financialSnapshotRepository->listByProject($projectId);
    }

    public function syncProject(int $projectId, string $externalProjectCode)
    {
        $payload = $this->financialSyncService->pullProjectFinancials($externalProjectCode);

        return $this->financialSnapshotRepository->create([
            'project_id' => $projectId,
            'crm_ref' => $externalProjectCode,
            'planned_budget' => $payload['planned_budget'] ?? 0,
            'actual_cost' => $payload['actual_cost'] ?? 0,
            'revenue' => $payload['revenue'] ?? 0,
            'captured_at' => now(),
        ]);
    }
}
