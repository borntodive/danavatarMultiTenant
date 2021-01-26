<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::domain('{account}.'.config('app.base_url'))->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        ddd($account);
    })->middleware('tenant');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/anamnesis', function () {
        return view('anamnesis.create');
    })->name('anamnesis');
});


