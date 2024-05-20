<?php

use App\Http\Controllers\EnergyController;
use App\Http\Controllers\EnergyUpController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\TrophyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('manager')->name('manager')->group(function () {
    Route::apiResource('/users' , UserController::class);
    Route::post('/users/add-wallet/{user}' , [UserController::class , 'add_wallet'])->name('add-wallet');
    Route::apiResource('/trophies' , TrophyController::class);
    Route::apiResource('/energy' , EnergyController::class);
//    Route::apiResource('energy-up' , EnergyUpController::class);
});
Route::prefix('status')->name('status')->group(function () {
    Route::put('/trophies/{trophy}' , [TrophyController::class , 'default'])->name('default');
});

