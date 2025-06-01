<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cadmin\cAccountController;
use App\Http\Controllers\cadmin\RoleController;
use App\Http\Controllers\sysadmin\sAccountController;
use App\Http\Controllers\inspector\iPrisonerController;
use App\Http\Controllers\Lawyer\myLawyerController;
use App\Http\Controllers\medical_officer\MedicalController;
use App\Http\Controllers\police_officer\PoliceController;
use App\Http\Controllers\security_officer\SecurityController;
use App\Http\Controllers\training_officer\TrainingController;
use App\Http\Controllers\visitor\VisitorController;
use App\Http\Controllers\police_commisioner\CommisinerControler;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VisitingRequestController;

use App\Models\Notification;
//test
// request
use Illuminate\Http\Request;
use App\Models\Requests;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\DisciplineOfficerController;
use App\Http\Controllers\DashboardController;
use App\Models\Prisoner;
use App\Models\MedicalAppointment;
use App\Models\LawyerAppointment;
use App\Models\NewVisitingRequest;
use App\Models\Visitor;

Route::get('/allactor', function () {
    return view('dashboard');
});

Route::get('/pdashboard', function () {
    return view('police_officer.dashboard');
});
Route::get('/', function () {
    return view('dashboard');
});
Route::get('/roles', function () {
    return view('cadmin.add_roles');
});

Route::post('/notifications/read/{id}', function ($id) {
    $notification = Notification::find($id);
    if ($notification) {
        $notification->update(['status' => 'read']);
    }
    return response()->json(['success' => true]);
});
Route::post('/requests/update-status/{id}', function ($id, Request $request) {
    $requestItem = Requests::find($id);
    if ($requestItem && in_array($request->status, ['pending', 'approved', 'rejected'])) {
        $requestItem->update(['status' => $request->status]);
        return response()->json(['success' => true, 'new_status' => $request->status]);
    }
    return response()->json(['success' => false, 'message' => 'Invalid status or request not found.']);
});
Route::get('/cdashboard', [CommisinerControler::class, 'dashboard'])->name('commisioner.comissioner');
Route::get('/release', [CommisinerControler::class, 'release_prisoner'])->name('commisioner.release_prisoner');
Route::get('/releasedprisoners', [CommisinerControler::class, 'releasedprisoners'])->name('commisioner.releasedprisoners');
Route::get('/ExecuteRequests', [CommisinerControler::class, 'ExecuteRequests'])->name('commisioner.ExecuteRequests');
Route::post('/ExecuteRequests', [CommisinerControler::class, 'ExecuteRequests'])->name('requests.start');
Route::post('/ExecuteRequests', [CommisinerControler::class, 'ExecuteRequests'])->name('requests.execute.cancel');
Route::post('/releasePrisoner', [CommisinerControler::class, 'releasePrisoner'])->name('release_prisoner');
Route::get('/prisonershow/{id}', [CommisinerControler::class, 'show']);
Route::get('/evaluate', [CommisinerControler::class, 'showEvaluationForm'])->name('commisinerControler.evaluate_request');
Route::post('/transferapprove', [CommisinerControler::class, 'approve'])->name('transfer.approve');

Route::get('/chart-data', [cAccountController::class, 'getChartData']);
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/prisons', [cAccountController::class, 'prisonstore'])->name('prison.store');

Route::middleware('role:3')->group(function () {
    Route::resource('accounts', cAccountController::class);
    Route::get('/dashboard', [cAccountController::class, 'dashboard'])->name('cadmin.dashboard');
    Route::get('/chart-data', [cAccountController::class, 'getChartData']);
    Route::resource('accounts', cAccountController::class);
    Route::post('/accounts', [RoleController::class, 'store'])->name('accounts.store');
    Route::get('/prisonadd', [cAccountController::class, 'prisonadd'])->name('prison.add');
    Route::get('/prisonsview', [cAccountController::class, 'prisonview'])->name('prison.view');
    Route::get('/prisonassign', [cAccountController::class, 'prisonassign'])->name('prison.assign');
    Route::get('/viewrequests', [cAccountController::class, 'view_requests'])->name('view.requests');
    Route::get('/viewroles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/addrole', [RoleController::class, 'addrole'])->name('roles.addrole');
    Route::get('/caccounts', [cAccountController::class, 'show_all'])->name('account.show_all');
    Route::get('/caccountadd', [cAccountController::class, 'account_add'])->name('account.add');
    Route::delete('/caccounts/{user_id}', [cAccountController::class, 'destroy'])->name('accounts.destroy');
    Route::get('/cprisoners', [cAccountController::class, 'show_prisoners'])->name('cprisoner.showAll');
    Route::get('/caddprison', [cAccountController::class, 'add_prison'])->name('add.prison');
    Route::get('/cviewprison', [cAccountController::class, 'view_prison'])->name('view.prison');
    Route::get('/generate', [cAccountController::class, 'generate'])->name('cadmin.generate');
    Route::get('/prisons', [cAccountController::class, 'getPrisons']);
    Route::get('/reports', [cAccountController::class, 'generateReport']);
    Route::post('/reports/store', [cAccountController::class, 'storeReport'])->name('reports.store');
    Route::get('/view_reports', [cAccountController::class, 'viewReports'])->name('cadmin.view_reports');
    Route::post('/initiate_backup', [cAccountController::class, 'initiateBackup'])->name('initiate_backup');
    Route::get('/view_backup', [cAccountController::class, 'viewBackupLogs'])->name('view_backup');
    Route::put('/prisons/{id}', [cAccountController::class, 'updateprison'])->name('prison.update');
    Route::delete('/prisons/{id}', [cAccountController::class, 'destroyprison'])->name('prison.destroy');
    Route::delete('/caccount/{user_id}', [cAccountController::class, 'destroyacc'])->name('caccount.destroy');
    Route::put('/saccount/change-password/{user_id}', [cAccountController::class, 'changePassword'])->name('account.change-password');
});
Route::post('/accounts', [cAccountController::class, 'store'])->name('accounts.store');

Route::put('/sysaccount/change-password/{user_id}', [sAccountController::class, 'changePasswordforsystem'])->name('account.change-password');

Route::put('/saccount/update/{id}', [sAccountController::class, 'update'])->name('saccount.update');
Route::delete('/saccount/delete/{id}', [sAccountController::class, 'destroy'])->name('saccount.destroy');
Route::put('/caccount/update/{id}', [cAccountController::class, 'update'])->name('caccount.update');
Route::delete('/caccount/delete/{id}', [cAccountController::class, 'destroy'])->name('caccount.destroy');
Route::get('/sysdashboard', [sAccountController::class, 'dashboard'])->name('system.dashboard');
Route::get('/sysadmin/generate_report', [sAccountController::class, 'generate'])->name('sysadmin.generate_report');
Route::get('/sreports', [sAccountController::class, 'generateReport'])->name('reports.generate');
Route::post('/sreports/store', [sAccountController::class, 'storeReport'])->name('reports.store');
Route::post('/sinitiate_backup', [sAccountController::class, 'initiateBackup'])->name('initiate_backup');
Route::get('/view_backup_recovery_logs', [sAccountController::class, 'viewBackupLogs'])->name('view_backup_recovery_logs');
Route::get('/sprison', [sAccountController::class, 'getPrisons'])->name('prisons.index');
Route::get('/sysadmin/view_account', [sAccountController::class, 'show_all'])->name('sysadmin.view_account');
Route::get('/sysadmin/create_account', [sAccountController::class, 'account_add'])->name('sysadmin.create_account');
Route::post('/sysadmin/store', [sAccountController::class, 'store'])->name('sysadmin.store');
Route::put('/sysadmin/update/{id}', [sAccountController::class, 'update'])->name('sysadmin.update');
Route::delete('/sysadmin/destroy/{id}', [sAccountController::class, 'destroy'])->name('sysadmin.destroy');
Route::get('/sysadmin/view_reports', [sAccountController::class, 'viewReports'])->name('sysadmin.view_reports');
Route::put('/saccount/{user_id}', [sAccountController::class, 'updateacc'])->name('saccount.update');
Route::delete('/saccount/{user_id}', [sAccountController::class, 'destroyacc'])->name('saccount.destroy');


Route::get('/saccounts', [sAccountController::class, 'show_all'])->name('saccount.show_all')->middleware('role:1');
Route::get('/saccountadd', [sAccountController::class, 'account_add'])->name('saccount.add')->middleware('role:1');
Route::delete('/saccounts/{user_id}', [sAccountController::class, 'destroy'])->name('saccounts.destroy')->middleware('role:1');
Route::get('/viewrequests', [cAccountController::class, 'view_requests'])->name('view.requests')->middleware('role:2');
Route::get('/show_allforin', [iPrisonerController::class, 'show_allforin'])->name('prisoner.show_allforin')->middleware('role:2');
Route::get('/view_appointments', [iPrisonerController::class, 'view_appointments'])->name('view.appointments')->middleware('role:2');
Route::get('/view_lawyer_appointments', [iPrisonerController::class, 'view_lawyer_appointments'])->name('lawyer.appointments')->middleware('role:2');
Route::get('/prisonersadd', [iPrisonerController::class, 'prisoner_add'])->name('prisoner.add')->middleware('role:2');
Route::delete('/prisoner/{id}', [iPrisonerController::class, 'destroy'])->name('prisoner.destroy')->middleware('role:2');
Route::post('/prisoner/{id}/status', [iPrisonerController::class, 'updateStatus'])->name('prisoner.updateStatus')->middleware('role:2');
Route::get('/inspectorviewjobs', [iPrisonerController::class, 'viewJobs'])->name('inspector.viewJobs')->middleware('role:2');
Route::get('/inspectorviewtrainingprograms', [iPrisonerController::class, 'viewTrainingPrograms'])->name('inspector.viewTrainingPrograms')->middleware('role:2');
Route::get('/lawyer', [iPrisonerController::class, 'lawyer'])->name('lawyer.add')->middleware('role:2');
Route::post('/lawyerstore', [iPrisonerController::class, 'lstore'])->name('lawyers.lstore');
Route::put('/lawyers/{id}', [iPrisonerController::class, 'update'])->name('lawyers.update'); // Update lawyer
Route::delete('/lawyers/{id}', [iPrisonerController::class, 'destroy'])->name('lawyers.destroy');
Route::get('/policeofficer', [iPrisonerController::class, 'policeofficer'])->name('assign.policeofficer');
Route::prefix('inspector')->name('inspector.')->group(function () {
    Route::post('/assignments', [iPrisonerController::class, 'assignlawyer'])->name('assignments.store');
    Route::put('/assignments/{assignment_id}', [iPrisonerController::class, 'updateassign'])->name('assignments.update');
Route::delete('/assignments/{assignment_id}', [iPrisonerController::class, 'destroyassign'])->name('assignments.destroy');
Route::post('/police-assignments', [iPrisonerController::class, 'assignpolice'])->name('police.assignments.store');
Route::put('/police-assignments/{assignment_id}', [iPrisonerController::class, 'updateasspolice'])->name('police.assignments.update');
Route::delete('/police-assignments/{assignment_id}', [iPrisonerController::class, 'destroyasspolice'])->name('police.assignments.destroy');
});
Route::get('/lawyershowall', [iPrisonerController::class, 'lawyershowall'])->name('lawyer.lawyershowall')->middleware('role:2');
Route::post('/assignments', [iPrisonerController::class, 'assignlawyer'])->name('assignments.store');
Route::get('/assignments', [iPrisonerController::class, 'asslawyer'])->name('assignments.view');
Route::get('/addroom', [iPrisonerController::class, 'addroom'])->name('room.add')->middleware('role:2');
Route::get('/showroom', [iPrisonerController::class, 'showroom'])->name('room.show')->middleware('role:2');
Route::get('/roomassign', [iPrisonerController::class, 'roomassign'])->name('room.assign')->middleware('role:2');
Route::get('/allocate', [iPrisonerController::class, 'allocate'])->name('room.allocate')->middleware('role:2');
Route::post('/rooms', [iPrisonerController::class, 'roomstore'])->name('room.store')->middleware('role:2');
Route::post('prisoner/allocate-room', [iPrisonerController::class, 'allocateRoom'])->name('prisoner.allocate_room')->middleware('role:2');
Route::post('/update-status/{id}', [iPrisonerController::class, 'updateStatus'])->name('update.status')->middleware('role:2');
Route::post('/prisoners', [iPrisonerController::class, 'store'])->name('prisoners.store');
Route::get('/idashboard', action: [iPrisonerController::class, 'idashboard'])->name('inspector.idashboard')->middleware('role:2');
Route::put('/lawyers/change-password/{lawyer_id}', [iPrisonerController::class, 'changePasswordd'])->name('lawyers.change-password');
Route::middleware('middleware')->group(function () {
    Route::get('/myprisoner', [myLawyerController::class, 'myprisoner'])->name('mylawyer.myprisoner');
    Route::get('createlegalappo', [myLawyerController::class, 'createlegalappo'])->name('mylawyer.createlegalappo');
    Route::get('/createrequest', [myLawyerController::class, 'createrequest'])->name('mylawyer.createrequest');
    Route::get('/viewappointment', [myLawyerController::class, 'viewappointment'])->name('mylawyer.viewappointment');
    Route::get('/viewrequest', [myLawyerController::class, 'viewrequest'])->name('mylawyer.viewrequest');
    Route::get('/ldashboard', [myLawyerController::class, 'ldashboard'])->name('mylawyer.ldashboard');
    Route::get('/myprisoners', [myLawyerController::class, 'myprisoners'])->name('mylawyer.myprisoners');
    Route::post('/requests/store', [myLawyerController::class, 'rstore'])->name('requests.store');
    Route::post('/appstore', [myLawyerController::class, 'astore'])->name('lawyer_appointments.store');
});
Route::post('/requestspstore', [myLawyerController::class, 'prstore'])->name('requestsfrompolice.store');

Route::get('/createrequestpolice', [myLawyerController::class, 'createrequestpolice'])->name('createrequestpolice');
Route::get('/viewrequestpolice', [myLawyerController::class, 'viewrequestpolice'])->name('viewrequestpolice');
Route::get('/prisoners', [iPrisonerController::class, 'show_all'])
    ->name('prisoner.showAll')
    ->middleware('role:2,8,5');
Route::post('prisoner/allocate-room', [iPrisonerController::class, 'allocateRoom'])->name('prisoner.allocate_room')->middleware('role:8');
Route::delete('/rooms/{id}', [iPrisonerController::class, 'roomdestroy'])->name('rooms.destroy');

Route::put('/rooms/{id}', [iPrisonerController::class, 'roomupdate'])->name('rooms.update');
Route::get('/addroom', [iPrisonerController::class, 'addroom'])->name('room.add')->middleware('role:8');
Route::get('/showroom', [iPrisonerController::class, 'showroom'])->name('room.show')->middleware('role:8');
Route::get('/roomassign', [iPrisonerController::class, 'roomassign'])->name('room.assign')->middleware('role:8');
Route::get('/allocate', [iPrisonerController::class, 'allocate'])->name('room.allocate')->middleware('role:8');
Route::post('/rooms', [iPrisonerController::class, 'roomstore'])->name('room.store')->middleware('role:8');
Route::get('/medicalreports', [MedicalController::class, 'createMedicalReport'])->name('medical.createReport');
Route::get('/viewmedicalappointments', [MedicalController::class, 'viewAppointments'])->name('medical.viewAppointments');
Route::get('/viewmedicalreports', [MedicalController::class, 'viewReports'])->name('medical.viewReports');
Route::post('/appointments/store', [MedicalController::class, 'mstore'])->name('appointments.store');
Route::post('/medical-reports/store', [MedicalController::class, 'mrstore'])->name('medical-reports.store');
Route::get('/medicaldashboard', [MedicalController::class, 'dashboard'])->name('medical.dashboard');

Route::prefix('medical-officer')->name('medical.')->group(function () {
    Route::get('/appointments/create', [MedicalController::class, 'createMedicalAppointment'])->name('createAppointment');
    Route::post('/appointments', [MedicalController::class, 'store'])->name('appointments.store');
    Route::put('/appointments/{id}', [MedicalController::class, 'update'])->name('appointments.update');
});
Route::get('/allocateRoom', [PoliceController::class, 'allocateRoom'])->name('police.allocateRoom')->middleware('role:8');
Route::post('/storeRoomAllocation', [PoliceController::class, 'storeRoomAllocation'])->name('police.storeRoomAllocation');
Route::get('/createRequest', [PoliceController::class, 'createRequest'])->name('police.createRequest');
Route::post('/storeRequest', [PoliceController::class, 'storeRequest'])->name('police.storeRequest');
Route::get('/viewPrisoners', [PoliceController::class, 'viewPrisoners'])->name('police.viewPrisoners');
Route::get('/viewRequests', [PoliceController::class, 'viewRequests'])->name('police.viewRequests');
Route::get('/viewRoomAllocations', [PoliceController::class, 'viewRoomAllocations'])->name('police.viewRoomAllocations');
Route::get('/createvisitingtime', [SecurityController::class, 'createVisitingTime'])->name('security.createVisitingTime');
Route::get('/registervisitor', [SecurityController::class, 'registerVisitor'])->name('security.registerVisitor');
Route::get('/sdashboard', [SecurityController::class, 'dashboard'])->name('security_officer.dashboard');
Route::get('/security/visitors/{id}', [SecurityController::class, 'showVisitor']);
Route::get('/registerVisitor', [SecurityController::class, 'registerVisitor'])->name('security_officer.registerVisitor');
Route::put('/security_officer/visitors/change-password/{visitor_id}', [SecurityController::class, 'changePassword'])->name('security_officer.changeVisitorPassword');
Route::get('/viewvisitors', [SecurityController::class, 'viewVisitors'])->name('security_officer.viewvisitors');
Route::get('/viewappointments', [SecurityController::class, 'viewAppointments'])->name('security.viewAppointments');
Route::get('/viewprisoners', [SecurityController::class, 'viewPrisoners'])->name('security.viewPrisoners');
Route::get('/assigncertifications', [TrainingController::class, 'assignCertifications'])->name('training.assignCertifications');
Route::get('/assignjobs', [TrainingController::class, 'assignJobs'])->name('training.assignJobs');
Route::get('/createtrainingprograms', [TrainingController::class, 'createTrainingPrograms'])->name('training.createTrainingPrograms');
Route::get('/viewjobs', [TrainingController::class, 'viewJobs'])->name('training.viewJobs');
Route::get('/viewtrainingprograms', [TrainingController::class, 'viewTrainingPrograms'])->name('training.viewTrainingPrograms');
Route::get('/assigntrainingprograms', [TrainingController::class, 'assignTrainingPrograms'])->name('training.assignTrainingPrograms');
Route::get('/viewassignedTrainingPrograms', [TrainingController::class, 'viewAssignedPrograms'])->name('training.viewassignedTrainingPrograms');
Route::post('/training-programs/store', [TrainingController::class, 'storeTrainingProgram'])->name('training_officer.store');
Route::put('/assign-training/unassign/{id}', [TrainingController::class, 'unassignTrainingProgram'])->name('assign_training.unassign');
Route::post('/assigntraining-programs/store', [TrainingController::class, 'assignTrainingProgram'])->name('assign_training.store');
Route::get('/assignjobs', [TrainingController::class, 'assignjobs'])->name('training.assignjobs');
Route::post('/assignJob', [TrainingController::class, 'assignJob'])->name('job.assign');
Route::delete('/jobs/{job}', [TrainingController::class, 'destroyjob'])
    ->name('jobs.destroyjob');
Route::put('training-programs/{id}', [TrainingController::class, 'update'])->name('training_officer.update');
Route::delete('training-programs/{id}', [TrainingController::class, 'destroy'])->name('training_officer.destroy');
Route::put('/jobs/update', [TrainingController::class, 'updatejob'])->name('jobs.update');
Route::delete('/training_officer/{id}', [TrainingController::class, 'destroy'])->name('trainingprogram.destroy');
Route::get('/tdashboard', [TrainingController::class, 'dashboard'])->name('training.dashboard');
Route::put('/jobs/{id}', [TrainingController::class, 'update'])->name('jobs.update');
Route::delete('/jobs/{id}', [TrainingController::class, 'destroy'])->name('jobs.destroyjob');
Route::put('/program-assignments/{id}', [TrainingController::class, 'updateAssign'])->name('program-assignments.update');
Route::post('/training-officer/prisoner-details', [TrainingController::class, 'getPrisonerDetails'])
    ->name('training_officer.getPrisonerDetails');
Route::post('/training-officer/certifications', [TrainingController::class, 'store'])
    ->name('training_officer.storeCertification');
Route::get('/viewcertifications', [TrainingController::class, 'viewCertificationss'])
    ->name('training.viewCertifications');
Route::get('/training-officer/certifications/{id}', [TrainingController::class, 'viewCertificate'])
    ->name('training.viewCertificate');
Route::get('/createvisitingrequest', [VisitorController::class, 'createVisitingRequest'])->name('visitor.createVisitingRequest')->middleware('role:4'); //visitor role id == 4
Route::get('/myvisitingrequests', [VisitorController::class, 'viewVisitingRequests'])->name('visitor.viewVisitingRequests');
Route::post('/change-password', [PasswordController::class, 'update'])->name('password.update');
Route::get('/editVisitor/{id}', [SecurityController::class, 'editVisitor'])->name('security_officer.editVisitor');
Route::post('/validate-prisoner', [SecurityController::class, 'validatePrisoner'])->name('validatePrisoner');
Route::post('/verify-prisoner', [SecurityController::class, 'verifyPrisoner'])->name('verify.prisoner');

Route::post('/verify-prisoner', [SecurityController::class, 'verify'])->name('verify.prisoner');

// Appointment Status Update Routes
Route::post('/update-appointment-status', [SecurityController::class, 'updateStatus'])->name('update.appointment.status');

//security_officer
Route::prefix('security_officer')->group(function () {
    Route::post('/storeVisitor', [SecurityController::class, 'storeVisitor'])->name('security_officer.storeVisitor');
    Route::post('/visitors/{id}/update', [VisitorController::class, 'update'])->name('updateVisitor');
    Route::post('/visitors/{id}/delete', [VisitorController::class, 'destroy'])->name('deleteVisitor');

    // Visitor Management

    Route::put('/updateVisitor/{id}', [SecurityController::class, 'updateVisitor'])->name('security_officer.updateVisitor');
    Route::delete('/deleteVisitor/{id}', [SecurityController::class, 'deleteVisitor'])->name('security_officer.deleteVisitor');

    // Visiting Time Management
    Route::get('/createvisitingtime', [SecurityController::class, 'createVisitingTime'])->name('security.createVisitingTime');

    // Other Views
    Route::get('/viewappointments', [SecurityController::class, 'viewAppointments'])->name('security.viewAppointments');
    Route::get('/viewprisoners', [SecurityController::class, 'viewPrisoners'])->name('security.viewPrisoners');
});
Route::get('/viewprisonerstatus', [SecurityController::class, 'viewprisonerstatus'])->name('security.viewprisonerstatus');
Route::post('/updateAppointmentStatus', [SecurityController::class, 'updateStatus'])->name('updateAppointmentStatus');
Route::get('/discipline_officer/requests/evaluate', [RequestController::class, 'showEvaluationForm'])->name('discipline_officer.evaluate_request');
Route::get('/show_prisoners', [RequestController::class, 'show_allforin'])->name('showprisoners');
Route::get('/ddashboard', [RequestController::class, 'dashboard'])->name('disdashboard');
Route::post('/approve-request/{id}', [RequestController::class, 'approveRequest'])->name('approve.request');
Route::post('/reject-request/{id}', [RequestController::class, 'rejectRequest'])->name('reject.request');
Route::post('/transfer-request/{id}', [RequestController::class, 'transferRequest'])->name(name: 'transfer.request');
Route::get('/prisoners/{id}', [RequestController::class, 'show'])->name('prisoners.show');
Route::post('/approve-appointment/{id}', [RequestController::class, 'approve']);
Route::post('/reject-appointment/{id}', [RequestController::class, 'reject']);
Route::post('/lawyer-approve-request/{id}', [RequestController::class, 'approveLawyerAppointment'])->name('lawyer-approve-request');
Route::post('/lawyer-reject-request/{id}', [RequestController::class, 'rejectLawyerAppointment'])->name('lawyer-reject-request');
Route::post('/lawyer-transfer-request/{id}', [RequestController::class, 'transferLawyerAppointment'])->name('lawyer-transfer-request');
Route::get('/showprisoners', [RequestController::class, 'show_allforin'])->name('prisoner.showprisoners');
Route::get('/visitor/register', [VisitorController::class, 'showRegistrationForm'])->name('visitor.register');
Route::post('/visitor/register', [VisitorController::class, 'register'])->name('visitor.register.submit');
Route::get('/vdashboard', [VisitorController::class, 'dashboard'])->name('visitor.dashboard');
Route::get('/createVisiting', [VisitorController::class, 'createVisiting'])->name('visitor.createVisiting');
Route::post('/visitorstore-request', [VisitorController::class, 'store'])->name('visitor.store_request');
Route::post('/visitor/submit-request', [VisitorController::class, 'submitRequest'])->name('visitor.submitRequest');
Route::get('/visitorvisiting-requests', [VisitorController::class, 'viewRequests'])->name('visitor.visitingRequests');
// In web.php
Route::post('/visiting-request/resubmit/{id}', [VisitorController::class, 'resubmitRequest'])->name('visitor.resubmitRequest');


// Route to show the visiting form
Route::get('/visitor/visiting-form', [VisitorController::class, 'showVisitingForm'])->name('visitor.visiting_form');

// Route to fetch prisoners based on selected prison
Route::get('/get-prisoners/{prisonId}', [VisitorController::class, 'getPrisonersByPrison']);

// Route to handle the form submission
Route::post('/visitor/visiting-request', [VisitorController::class, 'storeVisitRequest'])->name('visitor.store_request');

Route::get('/prisoners/{prisonerId}/appointments', function ($prisonerId) {
    // Fetch the prisoner by ID (you can adjust this to your app's logic)
    $prisoner = Prisoner::find($prisonerId);

    if (!$prisoner) {
        return response()->json(['error' => 'Prisoner not found'], 404);
    }

    // Get appointments for the prisoner (this assumes you have a relation set up)
    $appointments = $prisoner->appointments;  // Assuming there's a relationship method in the Prisoner model

    return response()->json($appointments);
});

// Home Page
Route::get('/', function () {
    return view('home'); // home.blade.php is in the views folder
})->name('home');

Route::get('/notifications', [NotificationController::class, 'fetch'])->name('notifications.fetch');
Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

Route::get('/test-session', function () {
    return response()->json([
        'session_data' => session()->all(),
        'session_id' => session()->getId()
    ]);
});
Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])
    ->name('notifications.markAllRead');