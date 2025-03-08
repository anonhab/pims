<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cadmin\cAccountController;
use App\Http\Controllers\sysadmin\sAccountController;
use App\Http\Controllers\inspector\iPrisonerController;
use App\Http\Controllers\Lawyer\myLawyerController;
use App\Http\Controllers\medical_officer\MedicalController;
use App\Http\Controllers\police_officer\PoliceController;
use App\Http\Controllers\security_officer\SecurityController;
use App\Http\Controllers\training_officer\TrainingController;
use App\Http\Controllers\visitor\VisitorController;

// Dashboard Routes
Route::get('/', function () {
    return view('dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

// ---------------------------------
// Resource Routes for Accounts (cAdmin)
Route::resource('accounts', cAccountController::class);
Route::get('/caccounts', [cAccountController::class, 'show_all'])->name('account.show_all');
Route::get('/caccountadd', [cAccountController::class, 'account_add'])->name('account.add');
Route::delete('/caccounts/{user_id}', [cAccountController::class, 'destroy'])->name('accounts.destroy');
Route::get('/cprisoners', [cAccountController::class, 'show_prisoners'])->name('cprisoner.showAll');
Route::get('/caddprison', [cAccountController::class, 'add_prison'])->name('add.prison');
Route::get('/cviewprison', [cAccountController::class, 'view_prison'])->name('view.prison');
// ---------------------------------
// Resource Routes for Accounts (SysAdmin)
Route::get('/saccounts', [sAccountController::class, 'show_all'])->name('saccount.show_all');
Route::get('/saccountadd', [sAccountController::class, 'account_add'])->name('saccount.add');
Route::delete('/saccounts/{user_id}', [sAccountController::class, 'destroy'])->name('saccounts.destroy');

// ---------------------------------
// Resource Routes for Prisoners (Inspector)
Route::resource('prisoners', iPrisonerController::class);
Route::get('/prisoners', [iPrisonerController::class, 'show_all'])->name('prisoner.showAll');
Route::get('/prisonersadd', [iPrisonerController::class, 'prisoner_add'])->name('prisoner.add');
Route::delete('/prisoner/{id}', [iPrisonerController::class, 'destroy'])->name('prisoner.destroy');
Route::post('/prisoner/{id}/status', [iPrisonerController::class, 'updateStatus'])->name('prisoner.updateStatus');

// ---------------------------------
// Lawyer Routes
Route::get('/lawyer', [iPrisonerController::class, 'lawyer'])->name('lawyer.add');
Route::get('/lawyershowall', [iPrisonerController::class, 'lawyershowall'])->name('lawyer.lawyershowall');

// ---------------------------------
// Room Routes
Route::get('/addroom', [iPrisonerController::class, 'addroom'])->name('room.add');
Route::get('/showroom', [iPrisonerController::class, 'showroom'])->name('room.show');

// ---------------------------------
// Lawyer Prisoner Routes
Route::get('/myprisoner', [myLawyerController::class, 'myprisoner'])->name('mylawyer.myprisoner');

// ---------------------------------
// Medical Routes
Route::get('/medicalappointments', [MedicalController::class, 'createMedicalAppointment'])->name('medical.createAppointment');
Route::get('/medicalreports', [MedicalController::class, 'createMedicalReport'])->name('medical.createReport');
Route::get('/viewmedicalappointments', [MedicalController::class, 'viewAppointments'])->name('medical.viewAppointments');
Route::get('/viewmedicalreports', [MedicalController::class, 'viewReports'])->name('medical.viewReports');

// ---------------------------------
// Police Routes
Route::get('/allocateRoom', [PoliceController::class, 'allocateRoom'])->name('police.allocateRoom');
Route::post('/storeRoomAllocation', [PoliceController::class, 'storeRoomAllocation'])->name('police.storeRoomAllocation');
Route::get('/createRequest', [PoliceController::class, 'createRequest'])->name('police.createRequest');
Route::post('/storeRequest', [PoliceController::class, 'storeRequest'])->name('police.storeRequest');
Route::get('/viewPrisoners', [PoliceController::class, 'viewPrisoners'])->name('police.viewPrisoners');
Route::get('/viewRequests', [PoliceController::class, 'viewRequests'])->name('police.viewRequests');
Route::get('/viewRoomAllocations', [PoliceController::class, 'viewRoomAllocations'])->name('police.viewRoomAllocations');

// ---------------------------------
// Security Routes
Route::get('/createvisitingtime', [SecurityController::class, 'createVisitingTime'])->name('security.createVisitingTime');
Route::get('/registervisitor', [SecurityController::class, 'registerVisitor'])->name('security.registerVisitor');
Route::get('/viewappointments', [SecurityController::class, 'viewAppointments'])->name('security.viewAppointments');
Route::get('/viewprisoners', [SecurityController::class, 'viewPrisoners'])->name('security.viewPrisoners');

// ---------------------------------
// Training Routes
Route::get('/assigncertifications', [TrainingController::class, 'assignCertifications'])->name('training.assignCertifications');
Route::get('/assignjobs', [TrainingController::class, 'assignJobs'])->name('training.assignJobs');
Route::get('/createtrainingprograms', [TrainingController::class, 'createTrainingPrograms'])->name('training.createTrainingPrograms');
Route::get('/viewcertifications', [TrainingController::class, 'viewCertifications'])->name('training.viewCertifications');
Route::get('/viewjobs', [TrainingController::class, 'viewJobs'])->name('training.viewJobs');
Route::get('/viewtrainingprograms', [TrainingController::class, 'viewTrainingPrograms'])->name('training.viewTrainingPrograms');

// ---------------------------------
// Visitor Routes
Route::get('/createvisitingrequest', [VisitorController::class, 'createVisitingRequest'])->name('visitor.createVisitingRequest');
Route::get('/myvisitingrequests', [VisitorController::class, 'viewVisitingRequests'])->name('visitor.viewVisitingRequests');
