<?php

namespace App\Integrations;

use App\Integrations\Contracts\KekaClientInterface;
use Illuminate\Support\Facades\Http;

class KekaClient implements KekaClientInterface
{
    public function fetchTimesheets(string $fromDate, string $toDate): array
    {
        return Http::withToken(config('services.keka.token'))
            ->get(config('services.keka.base_url').'/timesheets', [
                'from' => $fromDate,
                'to' => $toDate,
            ])->json() ?? [];
    }
}
