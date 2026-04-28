<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('timesheets', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('task_id')->nullable()->constrained('tasks')->nullOnDelete();
            $table->date('work_date');
            $table->unsignedInteger('minutes');
            $table->string('source', 30)->default('manual');
            $table->string('external_ref', 100)->nullable()->unique();
            $table->timestamps();
            $table->index(['user_id', 'work_date']);
        });

        Schema::create('financial_snapshots', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('crm_ref', 100)->nullable();
            $table->decimal('planned_budget', 14, 2)->default(0);
            $table->decimal('actual_cost', 14, 2)->default(0);
            $table->decimal('revenue', 14, 2)->default(0);
            $table->timestamp('captured_at');
            $table->timestamps();
            $table->index(['project_id', 'captured_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_snapshots');
        Schema::dropIfExists('timesheets');
    }
};
