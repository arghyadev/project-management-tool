<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table): void {
            $table->id();
            $table->string('code', 32)->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('phase', ['initiation', 'planning', 'execution', 'monitoring', 'closure', 'post-implementation']);
            $table->enum('status', ['draft', 'active', 'on-hold', 'completed', 'cancelled']);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('budget', 14, 2)->nullable();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->index(['status', 'phase']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
