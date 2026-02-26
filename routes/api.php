<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfilApiController;
use App\Http\Controllers\Api\MatchApiController;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

Route::post('/token', function (Request $request) {
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $request->password)) {
        return response()->json(['message' => 'Neispravni podaci.'], 401);
    }

    $token = $user->createToken('insomnia')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [ProfilApiController::class, 'me']);

    Route::get('/profili', [ProfilApiController::class, 'index']);
    Route::get('/profili/{profil}', [ProfilApiController::class, 'show']);

    Route::post('/profili/{profil}/like', [ProfilApiController::class, 'like']);
    Route::post('/profili/{profil}/dislike', [ProfilApiController::class, 'dislike']);

    Route::get('/matches', [MatchApiController::class, 'index']);
});