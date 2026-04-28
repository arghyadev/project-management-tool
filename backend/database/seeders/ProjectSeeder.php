<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::query()->first();

        if (! $owner) {
            return;
        }

        Project::query()->firstOrCreate([
            'code' => 'PMO-001',
        ], [
            'name' => 'Enterprise PMO Rollout',
            'description' => 'Seed project for Phase 1.',
            'phase' => 'planning',
            'status' => 'active',
            'created_by' => $owner->id,
        ]);
    }
}
