<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/api/documentation');
});

// Movie routes
Route::apiResource('movies', MovieController::class);

// Schedule routes
Route::apiResource('schedules', ScheduleController::class);
