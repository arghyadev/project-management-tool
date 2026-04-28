<?php

namespace App\Services;

use App\Integrations\Contracts\CrmClientInterface;

class FinancialSyncService
{
    public function __construct(private readonly CrmClientInterface $crmClient)
    {
    }

    public function pullProjectFinancials(string $externalProjectCode): array
    {
        return $this->crmClient->fetchProjectFinancials($externalProjectCode);
    }
}
