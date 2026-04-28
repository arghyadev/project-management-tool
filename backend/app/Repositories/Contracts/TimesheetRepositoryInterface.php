<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TimesheetRepositoryInterface
{
    public function filter(array $filters, int $perPage = 20): LengthAwarePaginator;

    public function upsertMany(array $rows): void;
}
