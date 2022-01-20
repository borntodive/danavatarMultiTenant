<?php

use App\Http\Controllers\Api\AlertController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DiveController;
use App\Http\Controllers\Api\InviteController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SampleController;
use App\Http\Controllers\Api\UserController;
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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->group( function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/users/{user:uuid}',[UserController::class, 'get']);
    Route::get('/users',[UserController::class, 'index']);

    Route::prefix('dives')->group(function() {
        Route::get('/user/{user_id}',[DiveController::class, 'getByUser']);
        Route::post('/{dive}/tank',[DiveController::class, 'storeTank']);
        Route::post('/{dive}/ppo2',[DiveController::class, 'storePPO2']);
        Route::post('/{dive}/diluent',[DiveController::class, 'storeDiluent']);
        Route::delete('/{dive}/tank',[DiveController::class, 'deleteTank']);
        Route::delete('/{dive}/ppo2',[DiveController::class, 'deletePPO2']);
        Route::get('/{dive}',[DiveController::class, 'get']);
        Route::post('/upload',[DiveController::class, 'store']);



        Route::get('/{dive_id}/saturation',[DiveController::class, 'getDivePointSaturation']);
    });
    Route::prefix('roles')->group(function() {
        Route::get('/',[RoleController::class, 'index']);
        Route::post('/',[RoleController::class, 'store']);
        Route::delete('/{role}',[RoleController::class, 'destroy']);
        Route::post('/user/{user}',[RoleController::class, 'updateUserRoles']);
    });

    Route::post('/samples', [SampleController::class, 'store'])->name('api.samples.store');
    Route::post('/dives', [SampleController::class, 'storeDives'])->name('api.samples.storeDives');

    Route::post('/alert', [AlertController::class, 'store'])->name('api.alert.store');

    Route::post('/invite', [InviteController::class,'store']);
});
