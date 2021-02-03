<?php

use App\Models\MedicalSpecialty;
use App\Models\User;
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
    //dd(session()->get('tenant_slug'));
    Route::middleware(['hasPermission:medical_doctor'])->group(function () {
        Route::get('/medical-record/{user}',  function (User $user) {
            return view('medicalRecord.show',compact('user'));
        })->name('medical_record.show');
        Route::get('/medical-record/{user}/{specialty}/create',  function (User $user,MedicalSpecialty $specialty) {
            return view('medicalRecord.create',compact('user','specialty'));
        })->name('medical_record.create');
        Route::get('/medical-record', function () {
            return view('medicalRecord.index');
        })->name('medical_record.index');


    });
    Route::middleware(['hasPermission:admin'])->group(function () {
        Route::get('/staff', function () {
            return view('staff.index');
        })->name('staff.index');
    });
});


