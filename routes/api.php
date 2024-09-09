<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersApiController;
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

Route::prefix('api/v1')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersApiController::class, 'index']);
        Route::post('/', [UsersApiController::class, 'store']);
        Route::put('/', [UsersApiController::class, 'update']);
        Route::delete('/', [UsersApiController::class, 'delete']);
    });
});