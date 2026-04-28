<?php

namespace App\Services;

use App\Events\MeetingCompletedEvent;

class MeetingAutomationService
{
    public function processMeeting(array $meetingPayload): void
    {
        if (($meetingPayload['status'] ?? null) === 'completed') {
            MeetingCompletedEvent::dispatch((int) $meetingPayload['id']);
        }
    }
}
