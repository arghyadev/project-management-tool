<?php

namespace App\Services;

use App\Models\ProjectMember;
use App\Repositories\Contracts\ProjectMemberRepositoryInterface;
use Illuminate\Support\Collection;

class ResourceAllocationService
{
    public function __construct(private readonly ProjectMemberRepositoryInterface $projectMemberRepository)
    {
    }

    public function listMembers(int $projectId): Collection
    {
        return $this->projectMemberRepository->listByProject($projectId);
    }

    public function addMember(int $projectId, array $data): ProjectMember
    {
        $data['project_id'] = $projectId;

        return $this->projectMemberRepository->create($data);
    }

    public function updateMember(ProjectMember $projectMember, array $data): ProjectMember
    {
        return $this->projectMemberRepository->update($projectMember, $data);
    }
}
