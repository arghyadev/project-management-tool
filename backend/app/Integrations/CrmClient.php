<?php

namespace App\Integrations;

use App\Integrations\Contracts\CrmClientInterface;
use Illuminate\Support\Facades\Http;

class CrmClient implements CrmClientInterface
{
    public function fetchProjectFinancials(string $externalProjectCode): array
    {
        return Http::withToken(config('services.crm.token'))
            ->get(config('services.crm.base_url').'/projects/'.$externalProjectCode.'/financials')
            ->json() ?? [];
    }
}
