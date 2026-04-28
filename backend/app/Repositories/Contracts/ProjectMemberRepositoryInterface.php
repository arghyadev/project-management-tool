<?php

namespace App\Repositories\Contracts;

use App\Models\ProjectMember;
use Illuminate\Support\Collection;

interface ProjectMemberRepositoryInterface
{
    public function listByProject(int $projectId): Collection;

    public function create(array $data): ProjectMember;

    public function update(ProjectMember $projectMember, array $data): ProjectMember;
}
