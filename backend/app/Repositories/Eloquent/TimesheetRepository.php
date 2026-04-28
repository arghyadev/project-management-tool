<?php

namespace App\Repositories\Eloquent;

use App\Models\Timesheet;
use App\Repositories\Contracts\TimesheetRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TimesheetRepository implements TimesheetRepositoryInterface
{
    public function filter(array $filters, int $perPage = 20): LengthAwarePaginator
    {
        return Timesheet::query()
            ->when($filters['user_id'] ?? null, fn ($q, $v) => $q->where('user_id', $v))
            ->when($filters['project_id'] ?? null, fn ($q, $v) => $q->where('project_id', $v))
            ->when($filters['date_from'] ?? null, fn ($q, $v) => $q->whereDate('work_date', '>=', $v))
            ->when($filters['date_to'] ?? null, fn ($q, $v) => $q->whereDate('work_date', '<=', $v))
            ->latest('work_date')
            ->paginate($perPage);
    }

    public function upsertMany(array $rows): void
    {
        Timesheet::query()->upsert($rows, ['external_ref'], ['minutes', 'work_date', 'source', 'task_id', 'project_id', 'user_id']);
    }
}
