<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'users'], function()
{
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{userId}', [UserController::class, 'show']);
    Route::get('/{userId}/activities/{activityId}', [UserController::class, 'activities']);
});

Route::group(['prefix' => 'activities'], function()
{
    Route::get('/', [ActivityController::class, 'index']);
    Route::get('/{activityId}', [ActivityController::class, 'show']);
});
