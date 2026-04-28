<?php

namespace App\Integrations\Contracts;

interface CrmClientInterface
{
    public function fetchProjectFinancials(string $externalProjectCode): array;
}
