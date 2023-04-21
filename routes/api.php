<?php

use App\Http\Controllers\API\RatingController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(RegisterController::class)->middleware(['throttle:registers'])->group(function() {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function() {
    Route::post('get-current-user', [UserController::class, 'getCurrentUser']);
    Route::post('update-current-user', [UserController::class, 'updateCurrentUser']);

    Route::post('create-service', [ServiceController::class, 'create']);
    Route::post('cancel-service', [ServiceController::class, 'cancel']);

    Route::post('create-rating', [RatingController::class, 'create']);

    Route::post('get-user-services', [ServiceController::class, 'getUserServices']);
});
