<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('manager')->name('manager')->group(function () {
    Route::apiResource('/users' , \App\Http\Controllers\Manager\UserController::class);
    Route::post('/users/add-wallet/{user}' , [\App\Http\Controllers\Manager\UserController::class , 'add_wallet'])->name('add-wallet');
    Route::apiResource('/trophies' , \App\Http\Controllers\TrophyController::class);
    Route::apiResource('/energy' , \App\Http\Controllers\EnergyController::class);
    Route::apiResource('energy-up' , \App\Http\Controllers\EnergyUpController::class);
});
Route::prefix('status')->name('status')->group(function () {
    Route::put('/trophies/{trophy}' , [\App\Http\Controllers\TrophyController::class , 'default'])->name('default');
});

