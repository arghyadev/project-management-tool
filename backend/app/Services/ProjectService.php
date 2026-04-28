<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectService
{
    public function __construct(private readonly ProjectRepositoryInterface $projectRepository)
    {
    }

    public function listForUser(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->projectRepository->paginateForUser($userId, $perPage);
    }

    public function create(array $data, int $userId): Project
    {
        $data['created_by'] = $userId;

        return $this->projectRepository->create($data);
    }

    public function update(Project $project, array $data): Project
    {
        return $this->projectRepository->update($project, $data);
    }

    public function delete(Project $project): void
    {
        $this->projectRepository->delete($project);
    }
}
