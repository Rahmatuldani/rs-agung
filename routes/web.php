<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChasierController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ReceptionistController;
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

Route::redirect('/', '/login', 301);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'redirect'])->group(function () {
    Route::resources([
        'admin' => AdminController::class,
        'receptionist' => ReceptionistController::class,
        'doctor' => DoctorController::class,
        'pharmacy' => PharmacyController::class,
        'logistic' => LogisticController::class,
        'chasier' => ChasierController::class,
    ]);

    Route::prefix('recept')->group(function () {
        Route::get('patient', [ReceptionistController::class, 'patient'])->name('receptionist.patient');
        Route::post('patientPoli/{id}', [ReceptionistController::class, 'patient_poli'])->name('receptionist.patientPoli');
        Route::get('rooms', [ReceptionistController::class, 'room'])->name('receptionist.room');
        Route::post('drooms/{id}', [ReceptionistController::class, 'dRoom'])->name('receptionist.droom');
        Route::get('print/{patient}', [ReceptionistController::class, 'cetak'])->name('receptionist.cetak');
    });

    Route::prefix('administrator')->group(function () {
        Route::get('users', [AdminController::class, 'users'])->name('admin.users');
        Route::post('restoreuser', [AdminController::class, 'restoreUser'])->name('admin.rusers');
        Route::get('polis', [AdminController::class, 'poli'])->name('admin.poli');
        Route::get('room', [AdminController::class, 'room'])->name('admin.room');
        Route::post('addpolis', [AdminController::class, 'addPoli'])->name('admin.addpoli');
        Route::post('addroom', [AdminController::class, 'addRoom'])->name('admin.addroom');
        Route::delete('deletepolis/{id}', [AdminController::class, 'deletePoli'])->name('admin.delpoli');
        Route::delete('deleteroom/{id}', [AdminController::class, 'deleteRoom'])->name('admin.delroom');
        Route::post('restorepolis', [AdminController::class, 'restorePoli'])->name('admin.restpoli');
        Route::get('restorepolis', [AdminController::class, 'restoreAllPoli'])->name('admin.restallpoli');
        Route::post('restoreroom', [AdminController::class, 'restoreRoom'])->name('admin.restroom');
        Route::get('restoreroom', [AdminController::class, 'restoreAllRoom'])->name('admin.restallroom');
        Route::post('editroom/{id}', [AdminController::class, 'editRoom'])->name('admin.editroom');
        Route::get('doctors', [AdminController::class, 'doctor'])->name('admin.doctor');
        Route::post('setdoc/{id}', [AdminController::class, 'setDoctor'])->name('admin.setdoc');
        Route::get('unsetdoc/{id}', [AdminController::class, 'unsetDoctor'])->name('admin.unsetdoc');
        Route::post('changePass', [AdminController::class, 'changePassword'])->name('admin.cpass');
        Route::get('test', [AdminController::class, 'test'])->name('admin.test');
    });

    Route::prefix('doc')->group(function () {
        Route::get('exam/{id}', [DoctorController::class, 'examPatient'])->name('doc.exam');
        Route::post('exam/{id}/{name}', [DoctorController::class, 'medrec'])->name('doc.medrec');
        Route::get('obat/{id}/{medrec}', [DoctorController:: class, 'obat'])->name('doc.obat');
        Route::post('obat/{id}/{medrec}', [DoctorController:: class, 'store'])->name('doc.setobat');
    });

    Route::prefix('pharm')->group(function () {
        Route::post('changePass', [PharmacyController::class, 'changePassword'])->name('pharm.cpass');
        Route::get('listobat', [PharmacyController::class, 'listObat'])->name('pharm.listobat');
        Route::post('cetak/{medrec}', [PharmacyController::class, 'cetak'])->name('pharm.cetak');
        Route::post('cetak/{medrec}', [PharmacyController::class, 'cetak'])->name('pharm.cetak');
    });

    Route::prefix('chas')->group(function () {
        Route::get('inpatient', [ChasierController::class, 'inpatient'])->name('chas.inpatient');
        Route::get('outpatient', [ChasierController::class, 'outpatient'])->name('chas.outpatient');
        Route::get('pinpatient/{id}', [ChasierController::class, 'pInpatient'])->name('chas.pinpatient');
        Route::get('poutpatient/{id}', [ChasierController::class, 'pOutpatient'])->name('chas.poutpatient');
    });

    Route::prefix('log')->group(function () {
        Route::get('report', [LogisticController::class, 'report'])->name('log.report');
        Route::get('listreport/{fracture}/{name}/{dist}', [LogisticController::class, 'listReport'])->name('log.listreport');
        Route::get('type', [LogisticController::class, 'type'])->name('log.type');
        Route::get('distributor', [LogisticController::class, 'distributor'])->name('log.distributor');
        Route::post('pdistributor', [LogisticController::class, 'pDistributor'])->name('log.pdistributor');
        Route::get('vdistributor', [LogisticController::class, 'vdistributor'])->name('log.vdistributor');
        Route::delete('destroyDist/{id}', [LogisticController::class, 'destroyDist'])->name('log.destroydist');
        Route::post('type', [LogisticController::class, 'addType'])->name('log.addtype');
        Route::get('vReport', [LogisticController::class, 'vReport'])->name('log.vreport');
        Route::post('addReport', [LogisticController::class, 'addReport'])->name('log.addreport');
        Route::delete('type/{id}', [LogisticController::class, 'typeDelete'])->name('log.typedelete');
    });

    Route::get('test/{date}', [AdminController::class, 'test'])->name('test');
});
