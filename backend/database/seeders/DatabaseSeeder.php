<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->firstOrCreate([
            'email' => 'pm.admin@company.com',
        ], [
            'name' => 'PM Admin',
            'password' => 'password123',
        ]);

        $this->call(ProjectSeeder::class);
    }
}
