<?php

namespace App\Repositories\Eloquent;

use App\Models\FinancialSnapshot;
use App\Repositories\Contracts\FinancialSnapshotRepositoryInterface;
use Illuminate\Support\Collection;

class FinancialSnapshotRepository implements FinancialSnapshotRepositoryInterface
{
    public function listByProject(int $projectId): Collection
    {
        return FinancialSnapshot::query()
            ->where('project_id', $projectId)
            ->latest('captured_at')
            ->get();
    }

    public function create(array $data): FinancialSnapshot
    {
        return FinancialSnapshot::query()->create($data);
    }
}
