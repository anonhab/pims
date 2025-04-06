<?php
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


Route::get('/allactor', function () {
    return view('dashboard');
});
Route::get('/sdashboard', function () {
    return view('sysadmin.dashboard');
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
;
Route::get('/notifications', function () {
    $userId = session('user_id'); 
    $prisonId = session('prison_id'); // Assuming prison_id is stored in session

    $notifications = Notification::where('account_id', $userId)
        ->where('prison_id', $prisonId) // Filtering by prison_id
        ->where('status', 'unread') 
        ->orderBy('created_at', 'desc')
        ->get();
        
    return response()->json($notifications);
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


Route::get('/chart-data', [cAccountController::class, 'getChartData']);
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);
Route::middleware('role:3')->group(function () {
    Route::resource('accounts', cAccountController::class);
    Route::get('/dashboard', [cAccountController::class, 'dashboard'])->name('cadmin.dashboard');
    Route::get('/chart-data', [cAccountController::class, 'getChartData']);
    Route::resource('accounts', cAccountController::class);
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/prisonadd', [cAccountController::class, 'prisonadd'])->name('prison.add');
    Route::post('/prisons', [cAccountController::class, 'prisonstore'])->name('prison.store');
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
});
Route::resource('prisoners', iPrisonerController::class);
Route::resource('accounts', cAccountController::class);
Route::put('/saccount/update/{id}', [sAccountController::class, 'update'])->name('saccount.update');
Route::delete('/saccount/delete/{id}', [sAccountController::class, 'destroy'])->name('saccount.destroy');
Route::put('/caccount/update/{id}', [cAccountController::class, 'update'])->name('caccount.update');
Route::delete('/caccount/delete/{id}', [cAccountController::class, 'destroy'])->name('caccount.destroy');


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
Route::get('/idashboard', function () {
    return view('inspector.dashboard');
})->middleware('role:2');
Route::middleware('middleware')->group(function () {
    Route::get('/myprisoner', [myLawyerController::class, 'myprisoner'])->name('mylawyer.myprisoner');
    Route::get('createlegalappo', [myLawyerController::class, 'createlegalappo'])->name('mylawyer.createlegalappo');
    Route::get('/createrequest', [myLawyerController::class, 'createrequest'])->name('mylawyer.createrequest');
    Route::get('/viewappointment', [myLawyerController::class, 'viewappointment'])->name('mylawyer.viewappointment');
    Route::get('/viewrequest', [myLawyerController::class, 'viewrequest'])->name('mylawyer.viewrequest');
    Route::get('/ldashboard', [myLawyerController::class, 'ldashboard'])->name('mylawyer.ldashboard');
    Route::get('/myprisoners', [myLawyerController::class, 'myprisoners'])->name('mylawyer.myprisoners');
    Route::post('/requests/store', [myLawyerController::class, 'rstore'])->name('requests.store');
    Route::post('/appointments/store', [myLawyerController::class, 'astore'])->name('lawyer_appointments.store');
});
Route::get('/prisoners', [iPrisonerController::class, 'show_all'])
    ->name('prisoner.showAll')
    ->middleware('role:2,8');
    Route::post('prisoner/allocate-room', [iPrisonerController::class, 'allocateRoom'])->name('prisoner.allocate_room')->middleware('role:8');

Route::get('/addroom', [iPrisonerController::class, 'addroom'])->name('room.add')->middleware('role:8');
Route::get('/showroom', [iPrisonerController::class, 'showroom'])->name('room.show')->middleware('role:8');
Route::get('/roomassign', [iPrisonerController::class, 'roomassign'])->name('room.assign')->middleware('role:8');
Route::get('/allocate', [iPrisonerController::class, 'allocate'])->name('room.allocate')->middleware('role:8');
Route::post('/rooms', [iPrisonerController::class, 'roomstore'])->name('room.store')->middleware('role:8');
Route::get('/medicalappointments', [MedicalController::class, 'createMedicalAppointment'])->name('medical.createAppointment');
Route::get('/medicalreports', [MedicalController::class, 'createMedicalReport'])->name('medical.createReport');
Route::get('/viewmedicalappointments', [MedicalController::class, 'viewAppointments'])->name('medical.viewAppointments');
Route::get('/viewmedicalreports', [MedicalController::class, 'viewReports'])->name('medical.viewReports');
Route::post('/appointments/store', [MedicalController::class, 'mstore'])->name('appointments.store');

Route::get('/allocateRoom', [PoliceController::class, 'allocateRoom'])->name('police.allocateRoom')->middleware('role:8');
Route::post('/storeRoomAllocation', [PoliceController::class, 'storeRoomAllocation'])->name('police.storeRoomAllocation');
Route::get('/createRequest', [PoliceController::class, 'createRequest'])->name('police.createRequest');
Route::post('/storeRequest', [PoliceController::class, 'storeRequest'])->name('police.storeRequest');
Route::get('/viewPrisoners', [PoliceController::class, 'viewPrisoners'])->name('police.viewPrisoners');
Route::get('/viewRequests', [PoliceController::class, 'viewRequests'])->name('police.viewRequests');
Route::get('/viewRoomAllocations', [PoliceController::class, 'viewRoomAllocations'])->name('police.viewRoomAllocations');
Route::get('/createvisitingtime', [SecurityController::class, 'createVisitingTime'])->name('security.createVisitingTime');
Route::get('/registervisitor', [SecurityController::class, 'registerVisitor'])->name('security.registerVisitor');
Route::get('/registerVisitor', [SecurityController::class, 'registerVisitor'])->name('security_officer.registerVisitor');

Route::get('/viewvisitors', [SecurityController::class, 'viewVisitors'])->name('security_officer.viewvisitors');
Route::get('/viewappointments', [SecurityController::class, 'viewAppointments'])->name('security.viewAppointments');
Route::get('/viewprisoners', [SecurityController::class, 'viewPrisoners'])->name('security.viewPrisoners');
Route::get('/assigncertifications', [TrainingController::class, 'assignCertifications'])->name('training.assignCertifications');
Route::get('/assignjobs', [TrainingController::class, 'assignJobs'])->name('training.assignJobs');
Route::get('/createtrainingprograms', [TrainingController::class, 'createTrainingPrograms'])->name('training.createTrainingPrograms');
Route::get('/viewcertifications', [TrainingController::class, 'viewCertifications'])->name('training.viewCertifications');
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


Route::get('/createvisitingrequest', [VisitorController::class, 'createVisitingRequest'])->name('visitor.createVisitingRequest');
Route::get('/myvisitingrequests', [VisitorController::class, 'viewVisitingRequests'])->name('visitor.viewVisitingRequests');
Route::post('/change-password', [PasswordController::class, 'update'])->name('password.update');
Route::get('/editVisitor/{id}', [SecurityController::class, 'editVisitor'])->name('security_officer.editVisitor');

//security_officer
Route::prefix('security_officer')->group(function () {
    Route::post('/storeVisitor', [SecurityController::class, 'storeVisitor'])->name('security_officer.storeVisitor');


    // Visitor Management
   
    Route::put('/updateVisitor/{id}', [SecurityController::class, 'updateVisitor'])->name('security_officer.updateVisitor');
    Route::delete('/deleteVisitor/{id}', [SecurityController::class, 'deleteVisitor'])->name('security_officer.deleteVisitor');

    // Visiting Time Management
    Route::get('/createvisitingtime', [SecurityController::class, 'createVisitingTime'])->name('security.createVisitingTime');

    // Other Views
    Route::get('/viewappointments', [SecurityController::class, 'viewAppointments'])->name('security.viewAppointments');
    Route::get('/viewprisoners', [SecurityController::class, 'viewPrisoners'])->name('security.viewPrisoners');
});



//Route::post('/discipline_officer/requests/evaluate', [DisciplineOfficerController::class, 'evaluateRequest'])->name('discipline_officer.evaluate_request');
Route::post('/discipline_officer/requests/evaluate', [DisciplineOfficerController::class, 'evaluate'])
    ->name('discipline_officer.evaluate_request');

Route::match(['get', 'post'], '/discipline_officer/requests/evaluate', [DisciplineOfficerController::class, 'showEvaluationForm'])->name('discipline_officer.evaluate_request');
// To show the form to evaluate the request
//Route::get('/discipline_officer/requests/evaluate/{request}', [DisciplineOfficerController::class, 'showEvaluationForm'])->name('discipline_officer.show_evaluation_form');

// Disciplinary Actions Routes for Discipline Officer
Route::get('discipline_officer/assign_penalty', [DisciplineOfficerController::class, 'assignPenalty'])->name('discipline_officer.assign_penalty');
Route::get('discipline_officer/view_penalties', [DisciplineOfficerController::class, 'viewPenalties'])->name('discipline_officer.view_penalties');

// Reports & Logs Routes for Discipline Officer
Route::get('discipline_officer/generate_reports', [DisciplineOfficerController::class, 'generateReports'])->name('discipline_officer.generate_reports');
Route::get('discipline_officer/view_logs', [DisciplineOfficerController::class, 'viewLogs'])->name('discipline_officer.view_logs');

Route::post('/approve-request/{id}', [RequestController::class, 'approveRequest'])->name('approve.request');
Route::post('/reject-request/{id}', [RequestController::class, 'rejectRequest'])->name('reject.request');
Route::get('/prisoners/{id}', [RequestController::class, 'show'])->name('prisoners.show');



// Home Page
Route::get('/', function () {
    return view('home'); // home.blade.php is in the views folder
})->name('home');