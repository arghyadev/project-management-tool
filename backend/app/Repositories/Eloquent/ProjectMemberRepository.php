<?php

namespace App\Repositories\Eloquent;

use App\Models\ProjectMember;
use App\Repositories\Contracts\ProjectMemberRepositoryInterface;
use Illuminate\Support\Collection;

class ProjectMemberRepository implements ProjectMemberRepositoryInterface
{
    public function listByProject(int $projectId): Collection
    {
        return ProjectMember::query()->where('project_id', $projectId)->latest('id')->get();
    }

    public function create(array $data): ProjectMember
    {
        return ProjectMember::query()->updateOrCreate(
            ['project_id' => $data['project_id'], 'user_id' => $data['user_id']],
            $data,
        );
    }

    public function update(ProjectMember $projectMember, array $data): ProjectMember
    {
        $projectMember->update($data);

        return $projectMember->refresh();
    }
}
