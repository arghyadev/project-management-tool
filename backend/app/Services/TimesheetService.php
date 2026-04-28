<?php

namespace App\Services;

use App\Repositories\Contracts\TimesheetRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TimesheetService
{
    public function __construct(private readonly TimesheetRepositoryInterface $timesheetRepository)
    {
    }

    public function list(array $filters): LengthAwarePaginator
    {
        return $this->timesheetRepository->filter($filters);
    }

    public function syncFromKeka(array $payload): void
    {
        $rows = array_map(static function (array $item): array {
            return [
                'external_ref' => $item['external_ref'] ?? null,
                'user_id' => $item['user_id'],
                'project_id' => $item['project_id'],
                'task_id' => $item['task_id'] ?? null,
                'work_date' => $item['work_date'],
                'minutes' => $item['minutes'],
                'source' => 'keka',
            ];
        }, $payload);

        $this->timesheetRepository->upsertMany($rows);
    }
}
