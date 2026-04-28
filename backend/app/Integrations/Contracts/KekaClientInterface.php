<?php

namespace App\Integrations\Contracts;

interface KekaClientInterface
{
    public function fetchTimesheets(string $fromDate, string $toDate): array;
}
