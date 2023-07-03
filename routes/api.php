<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

## Check api key before rendering Anything
Route::middleware('check.api_key')->prefix('v1')->group(function () {
    Route::controller(LocationController::class)->group(function () {
        Route::get('postcodes/{postcode?}','show');
    });
});

#Api key
Route::controller(UserController::class)->prefix('v1')->group(function () {
    Route::apiResource('apikeys',UserController::class);
});





