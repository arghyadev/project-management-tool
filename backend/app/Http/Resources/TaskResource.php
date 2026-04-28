<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'assignee_id' => $this->assignee_id,
            'due_date' => $this->due_date,
            'estimated_hours' => $this->estimated_hours,
            'created_at' => $this->created_at,
        ];
    }
}
