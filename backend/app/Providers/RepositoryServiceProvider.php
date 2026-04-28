<?php

namespace App\Providers;

use App\Integrations\CalendarClient;
use App\Integrations\Contracts\CalendarClientInterface;
use App\Integrations\Contracts\CrmClientInterface;
use App\Integrations\Contracts\KekaClientInterface;
use App\Integrations\CrmClient;
use App\Integrations\KekaClient;
use App\Repositories\Contracts\FinancialSnapshotRepositoryInterface;
use App\Repositories\Contracts\ProjectMemberRepositoryInterface;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\Contracts\TimesheetRepositoryInterface;
use App\Repositories\Eloquent\FinancialSnapshotRepository;
use App\Repositories\Eloquent\ProjectMemberRepository;
use App\Repositories\Eloquent\ProjectRepository;
use App\Repositories\Eloquent\TimesheetRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(ProjectMemberRepositoryInterface::class, ProjectMemberRepository::class);
        $this->app->bind(TimesheetRepositoryInterface::class, TimesheetRepository::class);
        $this->app->bind(FinancialSnapshotRepositoryInterface::class, FinancialSnapshotRepository::class);

        $this->app->bind(KekaClientInterface::class, KekaClient::class);
        $this->app->bind(CrmClientInterface::class, CrmClient::class);
        $this->app->bind(CalendarClientInterface::class, CalendarClient::class);
    }
}
