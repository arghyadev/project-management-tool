<?php

namespace App\Listeners;

use App\Events\MeetingCompletedEvent;
use App\Jobs\GenerateMomJob;

class QueueMeetingArtifacts
{
    public function handle(MeetingCompletedEvent $event): void
    {
        GenerateMomJob::dispatch($event->meetingId);
    }
}
