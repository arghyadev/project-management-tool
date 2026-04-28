<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (): array {
    return [
        'service' => 'PMO Backend API',
        'status' => 'ok',
    ];
});
