<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    public function listByProject(Project $project): Collection
    {
        return $project->tasks()->latest('id')->get();
    }

    public function create(Project $project, array $data): Task
    {
        return $project->tasks()->create($data);
    }
}
