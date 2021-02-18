<?php

use App\Http\Controllers\InvitesController;
use App\Http\Controllers\SampleController;
use App\Models\Anamnesis;
use App\Models\MedicalRecord;
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

Route::get('/test/ploi', [\App\Http\Controllers\TestController::class,'ploi']);
Route::get('/test/cloud', [\App\Http\Controllers\TestController::class,'cloud']);
Route::get('/invite/accept',App\Http\Livewire\Invite\Accept::class)->name('invite.accept');


Route::prefix('admin')->middleware(['auth:sanctum', 'verified','role:super_admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
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
            if (view()->exists('livewire.medical-record.create.' . $specialty->slug))
                return view('medicalRecord.create', compact('user', 'specialty'));
            abort(404);
        })->name('medical_record.create');
        Route::get('/medical-record', function () {
            return view('medicalRecord.index');
        })->name('medical_record.index');

        Route::get('/medical-record/{user}/{medicalRecord}', function (User $user, MedicalRecord $medicalRecord) {
            if (view()->exists('medicalRecord.view.' . $medicalRecord->specialty->slug))
                return view('medicalRecord.view', compact('user', 'medicalRecord'));
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


