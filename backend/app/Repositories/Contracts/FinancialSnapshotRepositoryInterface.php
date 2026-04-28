<?php

namespace App\Repositories\Contracts;

use App\Models\FinancialSnapshot;
use Illuminate\Support\Collection;

interface FinancialSnapshotRepositoryInterface
{
    public function listByProject(int $projectId): Collection;

    public function create(array $data): FinancialSnapshot;
}
