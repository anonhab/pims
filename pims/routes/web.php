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
use App\Http\Controllers\LoginController;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Requests;

use Illuminate\Support\Facades\Session;


// Dashboard Routes
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/', function () {
    return view('dashboard');
});
Route::get('/roles', function () {
    return view('cadmin.add_roles');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/notifications', function () {
    $userId = session('user_id'); // Get logged-in user's ID
    $notifications = Notification::where('account_id', $userId)
                                 ->where('status', 'unread') // Only fetch unread notifications
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
    $requestItem = Requests::find($id); // Find the request by ID

    if ($requestItem && in_array($request->status, ['pending', 'approved', 'rejected'])) {
        $requestItem->update(['status' => $request->status]); // Update with selected status
        return response()->json(['success' => true, 'new_status' => $request->status]);
    }

    return response()->json(['success' => false, 'message' => 'Invalid status or request not found.']);
});


Route::get('/components/{component}', function ($component) {
    return view("components.{$component}");
});
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);

// Admin routes
Route::middleware('middleware')->group(function () {
    Route::get('/prisons', [cAccountController::class, 'prisonadd'])->name('prison.add');

});
// ---------------------------------
// Grouping all routes with the role:3 middleware
Route::middleware('role:3')->group(function() {
    // Resource Routes for Accounts (cAdmin)
    Route::resource('accounts', cAccountController::class);

    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');

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
});

// ---------------------------------
// Resource Routes for Accounts (SysAdmin)
Route::get('/saccounts', [sAccountController::class, 'show_all'])->name('saccount.show_all')->middleware('role:1');
Route::get('/saccountadd', [sAccountController::class, 'account_add'])->name('saccount.add')->middleware('role:1');
Route::delete('/saccounts/{user_id}', [sAccountController::class, 'destroy'])->name('saccounts.destroy')->middleware('role:1');

// ---------------------------------
// Resource Routes for Prisoners (Inspector)
Route::get('/viewrequests', [cAccountController::class, 'view_requests'])->name('view.requests')->middleware('role:2');
Route::resource('prisoners', iPrisonerController::class)->middleware('role:2');
Route::get('/prisoners', [iPrisonerController::class, 'show_all'])->name('prisoner.showAll')->middleware('role:2');
Route::get('/view_appointments', [iPrisonerController::class, 'view_appointments'])->name('view.appointments')->middleware('role:2');
Route::get('/view_lawyer_appointments', [iPrisonerController::class, 'view_lawyer_appointments'])->name('lawyer.appointments')->middleware('role:2');
Route::get('/prisonersadd', [iPrisonerController::class, 'prisoner_add'])->name('prisoner.add')->middleware('role:2');
Route::delete('/prisoner/{id}', [iPrisonerController::class, 'destroy'])->name('prisoner.destroy')->middleware('role:2');
Route::post('/prisoner/{id}/status', [iPrisonerController::class, 'updateStatus'])->name('prisoner.updateStatus')->middleware('role:2');
Route::get('/inspectorviewjobs', [iPrisonerController::class, 'viewJobs'])->name('inspector.viewJobs')->middleware('role:2');
Route::get('/inspectorviewtrainingprograms', [iPrisonerController::class, 'viewTrainingPrograms'])->name('inspector.viewTrainingPrograms')->middleware('role:2');
//---------------------------------
// Lawyer Routes
Route::get('/lawyer', [iPrisonerController::class, 'lawyer'])->name('lawyer.add')->middleware('role:2');
Route::post('/lawyers/store', [iPrisonerController::class, 'lstore'])->name('lawyers.lstore');

Route::get('/lawyershowall', [iPrisonerController::class, 'lawyershowall'])->name('lawyer.lawyershowall')->middleware('role:2');

// ---------------------------------
// Room Routes
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



// ---------------------------------
// Lawyer Prisoner Routes
Route::get('/myprisoner', [myLawyerController::class, 'myprisoner'])->name('mylawyer.myprisoner');
Route::get('createlegalappo', [myLawyerController::class, 'createlegalappo'])->name('mylawyer.createlegalappo');
Route::get('/createrequest', [myLawyerController::class, 'createrequest'])->name('mylawyer.createrequest');
Route::get('/viewappointment', [myLawyerController::class, 'viewappointment'])->name('mylawyer.viewappointment');
Route::get('/viewrequest', [myLawyerController::class, 'viewrequest'])->name('mylawyer.viewrequest');
Route::get('/ldashboard', [myLawyerController::class, 'ldashboard'])->name('mylawyer.ldashboard');
Route::get('/myprisoners', [myLawyerController::class, 'myprisoners'])->name('mylawyer.myprisoners');


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
