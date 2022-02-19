<?php

use App\Http\Controllers\Api\AlertController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DiveController;
use App\Http\Controllers\Api\InviteController;
use App\Http\Controllers\Api\OperatorController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SampleController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Subscription;

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

Route::middleware('auth:sanctum')->group(function () {

    $team = session()->get('tenant');
    if ($team)
        $team = $team->slug;
    else
        $team = 'dsg';

    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/users/{user:id}', [UserController::class, 'get']);
    Route::get('/users', [UserController::class, 'index'])->middleware('permission:edit_users_roles,'.$team);
    Route::prefix('subscriptions')->group(function() {
        Route::get('/load', [SubscriptionController::class, 'index']);
        Route::get('/invoices', [SubscriptionController::class, 'getInvoices']);
        Route::get('/setup-intent', [SubscriptionController::class, 'getSetupIntent']);
        Route::post('/payment-method', [SubscriptionController::class, 'storePaymentMethod']);
        Route::get('/payment-method', [SubscriptionController::class, 'getPaymentMethod']);

    });



    Route::prefix('dives')->group(function () {
        Route::get('/user/{user_id}', [DiveController::class, 'getByUser']);
        Route::post('/{dive}/tank', [DiveController::class, 'storeTank']);
        Route::post('/{dive}/ppo2', [DiveController::class, 'storePPO2']);
        Route::post('/{dive}/diluent', [DiveController::class, 'storeDiluent']);
        Route::delete('/{dive}/tank', [DiveController::class, 'deleteTank']);
        Route::delete('/{dive}/ppo2', [DiveController::class, 'deletePPO2']);
        Route::get('/{dive}', [DiveController::class, 'get']);
        Route::post('/upload', [DiveController::class, 'store']);

        Route::get('/{dive_id}/saturation', [DiveController::class, 'getDivePointSaturation']);
    });
    Route::prefix('operator')->group(function () use ($team) {
        Route::post('/assign', [OperatorController::class, 'assignUserToOperator']);
        Route::get('/get_operator_users', [OperatorController::class, 'getOperatorUsers']);
        Route::delete('/{role}', [RoleController::class, 'destroy']);
        Route::post('/user/{user}', [RoleController::class, 'updateUserRoles'])->middleware('permission:edit_users_roles,' . $team);
    });
    Route::prefix('operator')->group(function () use ($team) {
        Route::post('/assign', [OperatorController::class, 'assignUserToOperator']);
        Route::get('/get_operator_users', [OperatorController::class, 'getOperatorUsers']);
        Route::delete('/{role}', [RoleController::class, 'destroy']);
        Route::post('/user/{user}', [RoleController::class, 'updateUserRoles'])->middleware('permission:edit_users_roles,' . $team);
    });
    Route::prefix('roles')->group(function () use ($team) {
        Route::get('/', [RoleController::class, 'index']);
        Route::post('/', [RoleController::class, 'store']);
        Route::delete('/{role}', [RoleController::class, 'destroy']);
        Route::post('/user/{user}', [RoleController::class, 'updateUserRoles'])->middleware('permission:edit_users_roles,' . $team);
    });

    Route::post('/samples', [SampleController::class, 'store'])->name('api.samples.store');
    Route::post('/dives', [SampleController::class, 'storeDives'])->name('api.samples.storeDives');

    Route::post('/alert', [AlertController::class, 'store'])->name('api.alert.store');

    Route::post('/invite', [InviteController::class, 'store']);
});
