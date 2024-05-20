<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EnergyController;
use App\Http\Controllers\EnergyUpController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\MultipleTouchesController;
use App\Http\Controllers\TBalanceController;
use App\Http\Controllers\TrophyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('manager')->name('manager')->group(callback: function () {
    Route::apiResource('/users' , UserController::class);
    Route::post('/users/add-wallet/{user}' , [UserController::class , 'add_wallet'])->name('add-wallet');
    Route::get('/users-state-chart' , [UserController::class , 'users_state_chart'])->name('users-state-chart');
    Route::apiResource('/trophies' , TrophyController::class);
    Route::apiResource('/energy' , EnergyController::class);
    Route::apiResource('/multi_touch' , MultipleTouchesController::class);
    Route::apiResource('/t_balance' , TBalanceController::class);
//    Route::apiResource('energy-up' , EnergyUpController::class);
});
Route::prefix('status')->name('status')->group(function () {
    Route::put('/trophies/{trophy}' , [TrophyController::class , 'default'])->name('default');
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('auth' , [RegisterController::class , 'auth'])->name('auth');
});
