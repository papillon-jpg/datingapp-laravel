<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthTokenController;
use App\Http\Controllers\Api\ProfilApiController;
use App\Http\Controllers\Api\StatsApiController;

Route::post('/token', [AuthTokenController::class, 'issue']); // login -> token

Route::middleware('auth:sanctum')->group(function () {
    // profili API
    Route::get('/profili', [ProfilApiController::class, 'index']);
    Route::get('/profili/{profil}', [ProfilApiController::class, 'show']);

    // statistika API
    Route::get('/stats', [StatsApiController::class, 'index']);

    // logout (obriše token)
    Route::post('/logout', [AuthTokenController::class, 'revoke']);
});