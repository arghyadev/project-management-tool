<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FinancialSnapshotResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'crm_ref' => $this->crm_ref,
            'planned_budget' => $this->planned_budget,
            'actual_cost' => $this->actual_cost,
            'revenue' => $this->revenue,
            'captured_at' => $this->captured_at,
        ];
    }
}
