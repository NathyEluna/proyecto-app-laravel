<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAPIController;
use App\Http\Controllers\API\PlanAPIController;
use App\Http\Controllers\API\SubscriptionAPIController;
use App\Http\Controllers\API\GameSessionAPIController;
use App\Http\Controllers\API\AuthController;

use App\Http\Controllers\UserController;

    /*
     * Authentication Routes
     */
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
    /*
     * User Routes
     */
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/users', [UserAPIController::class, 'index']);
        Route::post('/users', [UserAPIController::class, 'store']);
        Route::get('/users/{id}', [UserAPIController::class, 'show']);
        Route::put('/users/{id}', [UserAPIController::class, 'update']);
        Route::delete('/users/{id}', [UserAPIController::class, 'destroy']);
    });

    /*
     * Plan Routes
     */
    Route::get('/plans', [PlanAPIController::class, 'index']);
    Route::get('/plans/{id}', [PlanAPIController::class, 'show']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/plans', [PlanAPIController::class, 'store']);
        Route::put('/plans/{id}', [PlanAPIController::class, 'update']);
        Route::delete('/plans/{id}', [PlanAPIController::class, 'destroy']);
    });

    /*
     * Subscription Routes
     */
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/subscriptions', [SubscriptionAPIController::class, 'index']);
        Route::post('/subscriptions', [SubscriptionAPIController::class, 'store']);
        Route::get('/subscriptions/{id}', [SubscriptionAPIController::class, 'show']);
        Route::put('/subscriptions/{id}', [SubscriptionAPIController::class, 'update']);
        Route::delete('/subscriptions/{id}', [SubscriptionAPIController::class, 'destroy']);
    });

    /*
     * Game Session Routes
     */
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/game-sessions', [GameSessionAPIController::class, 'index']);
        Route::post('/game-sessions', [GameSessionAPIController::class, 'store']);
        Route::get('/game-sessions/{id}', [GameSessionAPIController::class, 'show']);
    });


