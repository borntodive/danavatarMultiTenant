<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\InvitesController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\TestController;
use App\Models\Anamnesis;
use App\Models\MedicalRecord;
use App\Models\MedicalSpecialty;
use App\Models\Tenant;
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

Route::get('/test/ploi', [\App\Http\Controllers\TestController::class,'ploi']);
Route::get('/test/cloud', [\App\Http\Controllers\TestController::class,'cloud']);
Route::get('/invite/accept',App\Http\Livewire\Invite\Accept::class)->name('invite.accept');
Route::get('/test/send-invite', [\App\Http\Controllers\TestController::class,'sendInvite']);
Route::get('/test/influx', [\App\Http\Controllers\TestController::class,'influx']);
Route::get('/test/gf',[TestController::class, 'testGF']);
Route::get('/test/sort',[TestController::class, 'sort']);
Route::get('/reset/dsg-roles',[TestController::class, 'resetDsgRoles']);
Route::get('/test/cc',[TestController::class, 'mollie']);
Route::get('/test/error', function () {
    echo $pippo['pluto'];
});

Route::prefix('admin')->middleware(['auth:sanctum', 'verified','role:super_admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/centers', function () {
        return view('admin.centers.index');
    })->name('admin.centers');
    Route::get('/centers/{tenant}/update', function (Tenant $tenant) {
        return view('admin.centers.update',compact('tenant'));
    })->name('admin.centers.update');
    Route::get('/centers/{tenant}', function (Tenant $tenant) {
        return view('admin.centers.show',compact('tenant'));
    })->name('admin.centers.show');
});
//->domain('{account}.'.config('app.base_url'))
Route::middleware(['auth:sanctum', 'verified','subdomain'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/anamnesis', function () {
        return view('anamnesis.create');
    })->name('anamnesis');
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');



    Route::middleware(['hasPermission:medical_doctor'])->group(function () {
        Route::get('/medical-record/{user}', function (User $user) {
            return view('medicalRecord.show', compact('user'));
        })->name('medical_record.show');
        Route::get('/medical-record/{user}/{specialty}/create', function (User $user, MedicalSpecialty $specialty) {
            $medicalRecord=new MedicalRecord();
            if (view()->exists('livewire.medical-record.' . $specialty->slug.'.edit'))
                return view('medicalRecord.create', compact('user', 'specialty','medicalRecord'));
            abort(404);
        })->name('medical_record.create');
        Route::get('/medical-record/{user}/{medicalRecord}/edit', function (User $user, MedicalRecord $medicalRecord) {
            $specialty=$medicalRecord->specialty;
            if (view()->exists('livewire.medical-record.' . $specialty->slug.'.edit'))
                return view('medicalRecord.edit', compact('user', 'specialty','medicalRecord'));
            abort(404);
        })->name('medical_record.edit');
        Route::get('/medical-record', function () {
            return view('medicalRecord.index');
        })->name('medical_record.index');


        Route::get('/medical-record/{user}/{medicalRecord}', function (User $user, MedicalRecord $medicalRecord) {
            $specialty=$medicalRecord->specialty;
            if (view()->exists('livewire.medical-record.' . $medicalRecord->specialty->slug . '.view'))
                return view('medicalRecord.view', compact('user', 'specialty','medicalRecord'));
            abort(404);
        })->name('medical-record.view');

        Route::get('/anamnesis/{user}/{anamnesis}', function (User $user, Anamnesis $anamnesis) {
            $medicalConditions = AnamnesisData::medicalConditions();
            $medications = AnamnesisData::medications();
            return view('anamnesis.show', compact('medications', 'medicalConditions', 'anamnesis', 'user'));
        })->name('anamnesis.show');
        Route::middleware(['tenantHasSpecialty:wearable'])->group(function () {
            Route::get('/wearable/{user}/samples', [SampleController::class,'index'])->name('wearable.samples');
            Route::get('/wearable/{user}/samples/ecg', [SampleController::class, 'viewEcg'])->name('wearable.ecg.day');
            Route::get('/wearable/{user}/samples/ecg/live', [SampleController::class, 'viewEcgLive'])->name('wearable.ecg.live');


            Route::get('/wearable/{user}', function (User $user) {
                return view('wearable.calendar', compact('user'));
            })->name('wearable.calendar');
        });


    });

    Route::middleware(['hasPermission:admin'])->group(function () {
        Route::get('/patients', function () {
            return view('patient.index');
        })->name('patient.index');
        Route::get('/staff', function () {
            return view('staff.index');
        })->name('staff.index');
    });
});

Route::prefix('ajax')->middleware(['auth:sanctum', 'verified','tenantHasSpecialty:wearable'])->group(function () {
    Route::get('/samples/per-month', [SampleController::class, 'getSampleByMonth'])->name('ajax.sample.month');
    Route::get('/samples/per-day', [SampleController::class, 'getSampleByDate'])->name('ajax.sample.day');
    Route::get('/samples/ecg/per-day', [SampleController::class, 'getEcgByDate'])->name('ajax.sample.ecg.day');
    Route::get('/samples/ecg/comments', [CommentController::class, 'getCommentByDate'])->name('ajax.sample.ecg.comments');
    Route::get('/samples/ecg/measures', [SampleController::class, 'getMeasureses'])->name('ajax.sample.ecg.measures');
    Route::post('/samples/ecg/comments', [CommentController::class, 'update'])->name('ajax.sample.ecg.comment.update');
    Route::delete('/samples/ecg/comments', [CommentController::class, 'delete'])->name('ajax.sample.ecg.comment.delete');


});


