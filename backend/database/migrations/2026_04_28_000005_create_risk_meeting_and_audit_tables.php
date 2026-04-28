<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('risks', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->enum('severity', ['low', 'medium', 'high', 'critical']);
            $table->enum('probability', ['low', 'medium', 'high']);
            $table->enum('status', ['open', 'mitigated', 'accepted', 'closed'])->default('open');
            $table->text('mitigation_plan')->nullable();
            $table->timestamps();
        });

        Schema::create('issues', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->enum('status', ['open', 'in-progress', 'resolved', 'closed'])->default('open');
            $table->text('resolution')->nullable();
            $table->timestamps();
        });

        Schema::create('meetings', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('external_meeting_id', 150)->unique();
            $table->string('title');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled']);
            $table->string('transcript_url')->nullable();
            $table->timestamps();
        });

        Schema::create('meeting_artifacts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('meeting_id')->constrained('meetings')->cascadeOnDelete();
            $table->enum('type', ['MOM', 'NOTES', 'SOW']);
            $table->longText('content');
            $table->unsignedInteger('version')->default(1);
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });

        Schema::create('audit_logs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('actor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('entity_type');
            $table->unsignedBigInteger('entity_id');
            $table->string('action');
            $table->json('before')->nullable();
            $table->json('after')->nullable();
            $table->timestamps();
            $table->index(['entity_type', 'entity_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('meeting_artifacts');
        Schema::dropIfExists('meetings');
        Schema::dropIfExists('issues');
        Schema::dropIfExists('risks');
    }
};
