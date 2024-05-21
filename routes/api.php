<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EnergyController;
use App\Http\Controllers\EnergyUpController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\MultipleTouchesController;
use App\Http\Controllers\RechargingController;
use App\Http\Controllers\TBalanceController;
use App\Http\Controllers\TrophyController;
use App\Http\Controllers\User\InfoUserController;
use App\Http\Controllers\User\LevelUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('manager')->name('manager')->group(callback: function () {
    Route::apiResource('/users' , UserController::class);
    Route::post('/users/add-wallet/{user}' , [UserController::class , 'add_wallet'])->name('add-wallet');
    Route::get('/users-state-chart' , [UserController::class , 'users_state_chart'])->name('users-state-chart');
    Route::apiResource('/trophies' , TrophyController::class);
    Route::apiResource('/energy' , EnergyController::class);
    Route::apiResource('/recharging' , RechargingController::class);
    Route::apiResource('/multi_touch' , MultipleTouchesController::class);
    Route::apiResource('/t_balance' , TBalanceController::class);
//    Route::apiResource('energy-up' , EnergyUpController::class);
});
Route::prefix('status')->name('status')->group(function () {
    Route::put('/trophies/{trophy}' , [TrophyController::class , 'default'])->name('default');
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login-register' , [RegisterController::class , 'auth'])->name('login-register');
});



Route::prefix('landing')->name('landing.')->group(function () {
    Route::get('info-trophy' , [InfoUserController::class , 'trophy'] )->name('info-trophy');
    Route::get('info-energy' , [InfoUserController::class , 'energy'] )->name('info-energy');
    Route::get('info-multi' , [InfoUserController::class , 'multi'] )->name('info-multi');
    Route::get('info-t_balance' , [InfoUserController::class , 't_balance'] )->name('info-t_balance');
    Route::get('info-recharging' , [InfoUserController::class , 'recharging'] )->name('info-recharging');
});


Route::prefix('level-up')->name('up.')->group(function () {
    Route::get('energy' , [LevelUpController::class , 'energy'] )->name('info-energy');
    Route::get('multi' , [LevelUpController::class , 'multi'] )->name('info-multi');
    Route::get('recharging' , [LevelUpController::class , 'recharging'] )->name('info-recharging');
});
