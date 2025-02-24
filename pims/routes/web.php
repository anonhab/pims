<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrisonController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PrisonerController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalReportController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\TrainingProgramController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\VisitingTimeRequestController;
use App\Models\Account;

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Resource Routes
Route::resource('accounts', AccountController::class);
Route::get('/accounts', [AccountController::class, 'show_all'])->name('account.showAll');
Route::get('/accountadd', [AccountController::class, 'account_add'])->name('account.add');
Route::delete('/accounts/{user_id}', [AccountController::class, 'destroy'])->name('accounts.destroy');

Route::resource('prisoners', PrisonerController::class);
Route::get('/prisoners', [PrisonerController::class, 'show_all'])->name('prisoner.showAll');
Route::get('/prisonersadd', [PrisonerController::class, 'prisoner_add'])->name('prisoner.add');
Route::delete('/prisoner/{id}', [PrisonerController::class, 'destroy'])->name('prisoner.destroy');
Route::post('/prisoner/{id}/status', [PrisonerController::class, 'updateStatus'])->name('prisoner.updateStatus');

// routes/api.php
Route::get('/prisoner/{id}', [PrisonerController::class, 'show']);



Route::delete('/prisoner/{id}', [PrisonerController::class, 'destroy'])->name('prisoner.destroy');
Route::delete('prisoner/{id}', [PrisonerController::class, 'destroy'])->name('prisoner.destroy');

Route::resource('requests', RequestController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('medical_reports', MedicalReportController::class);
Route::resource('visitors', VisitorController::class);
Route::resource('training_programs', TrainingProgramController::class);
Route::resource('jobs', JobController::class);
Route::resource('certifications', CertificationController::class);
Route::resource('reports', ReportController::class);
Route::resource('backups', BackupController::class);
Route::resource('lawyers', LawyerController::class);
Route::resource('rooms', RoomController::class);
Route::resource('visiting_time_requests', VisitingTimeRequestController::class);
Route::resource('prisons', PrisonController::class);

// Visiting Time Requests
Route::get('/create_visiting_time_request', function () {
    return view('create_visiting_time_request');
});
Route::get('/view_visiting_time_requests', function () {
    return view('view_visiting_time_requests');
});
