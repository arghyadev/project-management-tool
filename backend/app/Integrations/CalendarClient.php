<?php

namespace App\Integrations;

use App\Integrations\Contracts\CalendarClientInterface;
use Illuminate\Support\Facades\Http;

class CalendarClient implements CalendarClientInterface
{
    public function getMeetingByExternalId(string $meetingId): array
    {
        return Http::withToken(config('services.calendar.token'))
            ->get(config('services.calendar.base_url').'/meetings/'.$meetingId)
            ->json() ?? [];
    }
}
