<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\IntegrationController;
use App\Http\Controllers\Api\V1\TimesheetController;
use App\Http\Controllers\Api\V1\ResourceAllocationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/me', [AuthController::class, 'me']);

        Route::apiResource('projects', ProjectController::class);
        Route::get('/projects/{project}/tasks', [TaskController::class, 'index']);
        Route::post('/projects/{project}/tasks', [TaskController::class, 'store']);

        Route::post('/integrations/keka/sync', [IntegrationController::class, 'syncKeka']);
        Route::post('/integrations/crm/sync', [IntegrationController::class, 'syncCrm']);
        Route::post('/integrations/calendar/webhook', [IntegrationController::class, 'calendarWebhook']);
        Route::get('/projects/{project}/members', [ResourceAllocationController::class, 'index']);
        Route::post('/projects/{project}/members', [ResourceAllocationController::class, 'store']);
        Route::patch('/project-members/{projectMember}', [ResourceAllocationController::class, 'update']);

        Route::get('/timesheets', [TimesheetController::class, 'index']);
        Route::post('/timesheets/sync', [TimesheetController::class, 'sync']);
    });
});
