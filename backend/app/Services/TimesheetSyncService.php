<?php

namespace App\Services;

use App\Integrations\Contracts\KekaClientInterface;

class TimesheetSyncService
{
    public function __construct(private readonly KekaClientInterface $kekaClient)
    {
    }

    public function sync(string $fromDate, string $toDate): array
    {
        return $this->kekaClient->fetchTimesheets($fromDate, $toDate);
    }
}
