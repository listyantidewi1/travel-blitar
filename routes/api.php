<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\api\PlaceController;
use App\Http\Controllers\AuthenticationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('v1/auth/login', [AuthenticationController::class, 'login']);
Route::get('v1/auth/logout', [AuthenticationController::class, 'logout']);

Route::middleware('middlewareplace')->prefix("v1")->group(function () {
    Route::prefix('place')->group(function () {
        Route::get('/', [PlaceController::class, 'allplace']);
        Route::post('/', [PlaceController::class, 'createplace']);
        Route::delete('/{id}', [PlaceController::class, 'deleteplace']);
        Route::post('/{id}', [PlaceController::class, 'updateplace']);
        Route::get('/{id}', [PlaceController::class, 'findplace']);
    });

    Route::prefix('schedule')->group(function () {
        Route::post('/', [ScheduleController::class, 'createschedule']);
    });
});
