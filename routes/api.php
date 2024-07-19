<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\ActorController;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

// Public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protected routes
Route::middleware([
    EnsureFrontendRequestsAreStateful::class,
    'auth:sanctum',
])->group(function () {
    Route::get('movies', [MovieController::class, 'index']);
    Route::get('movies/{id}', [MovieController::class, 'show']);
    Route::get('directors/{id}', [DirectorController::class, 'show']);
    Route::get('actors/{id}', [ActorController::class, 'show']);
    Route::get('movies/genres', [MovieController::class, 'moviesWithGenres']);
    Route::get('movies/genre/{genreId}', [MovieController::class, 'moviesByGenre']);
    Route::get('movies/ratings', [MovieController::class, 'moviesWithRatings']);
});
