<?php

use App\Http\Controllers\InvitesController;
use App\Models\Anamnesis;
use App\Models\MedicalSpecialty;
use App\Models\User;
use App\StaticData\Anamnesis as AnamnesisData;
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

Route::get('/invite/accept',App\Http\Livewire\Invite\Accept::class)->name('invite.accept');


Route::prefix('admin')->middleware(['auth:sanctum', 'verified','role:super_admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/anamnesis', function () {
        return view('anamnesis.create');
    })->name('anamnesis');


    Route::middleware(['hasPermission:medical_doctor'])->group(function () {
        Route::get('/medical-record/{user}',  function (User $user) {
            return view('medicalRecord.show',compact('user'));
        })->name('medical_record.show');
        Route::get('/medical-record/{user}/{specialty}/create',  function (User $user,MedicalSpecialty $specialty) {
            if(view()->exists('livewire.medical-record.create.'.$specialty->slug))
                return view('medicalRecord.create',compact('user','specialty'));
            abort(404);
        })->name('medical_record.create');
        Route::get('/medical-record', function () {
            return view('medicalRecord.index');
        })->name('medical_record.index');

        Route::get('/anamnesis/{user}/{anamnesis}', function (User $user,Anamnesis $anamnesis) {
            $medicalConditions=AnamnesisData::medicalConditions();
            $medications=AnamnesisData::medications();
            return view('anamnesis.show',compact('medications','medicalConditions','anamnesis','user'));
        })->name('anamnesis.show');

    });

    Route::middleware(['hasPermission:admin'])->group(function () {
        Route::get('/staff', function () {
            return view('staff.index');
        })->name('staff.index');
    });


});


