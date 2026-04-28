<?php

namespace App\Integrations\Contracts;

interface CalendarClientInterface
{
    public function getMeetingByExternalId(string $meetingId): array;
}
