<?php

namespace App\Providers;

use App\Events\MeetingCompletedEvent;
use App\Listeners\QueueMeetingArtifacts;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MeetingCompletedEvent::class => [
            QueueMeetingArtifacts::class,
        ],
    ];
}
