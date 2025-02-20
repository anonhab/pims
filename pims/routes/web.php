<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});
 

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Account Management
Route::get('/create_account', function () {
    return view('create_account');
});
Route::get('/view_account', function () {
    return view('view_account');
});

// Prisoner Management
Route::get('/add_prisoner', function () {
    return view('add_prisoner');
});
Route::get('/view_prisoner', function () {
    return view('view_prisoner');
});
Route::get('/assign_room', function () {
    return view('assign_room');
});

// Request Management
Route::get('/create_request', function () {
    return view('create_request');
});
Route::get('/view_requests', function () {
    return view('view_requests');
});

// Appointment Management
Route::get('/create_appointment', function () {
    return view('create_appointment');
});
Route::get('/view_appointments', function () {
    return view('view_appointments');
});

// Medical Management
Route::get('/create_medical_report', function () {
    return view('create_medical_report');
});
Route::get('/view_medical_reports', function () {
    return view('view_medical_reports');
});

// Visitor Registration
Route::get('/register_visitor', function () {
    return view('register_visitor');
});
Route::get('/view_visitor_registrations', function () {
    return view('view_visitor_registrations');
});

// Training Programs
Route::get('/create_training_program', function () {
    return view('create_training_program');
});
Route::get('/view_training_programs', function () {
    return view('view_training_programs');
});

// Job Management
Route::get('/assign_job', function () {
    return view('assign_job');
});
Route::get('/view_jobs', function () {
    return view('view_jobs');
});

// Certification Management
Route::get('/assign_certification', function () {
    return view('assign_certification');
});
Route::get('/view_certifications', function () {
    return view('view_certifications');
});

// Report Generation
Route::get('/generate_report', function () {
    return view('generate_report');
});
Route::get('/view_reports', function () {
    return view('view_reports');
});

// Backup and Recovery
Route::get('/initiate_backup', function () {
    return view('initiate_backup');
});
Route::get('/view_backup_recovery_logs', function () {
    return view('view_backup_recovery_logs');
});

// Lawyer Management
Route::get('/add_lawyer', function () {
    return view('add_lawyer');
});
Route::get('/view_lawyers', function () {
    return view('view_lawyers');
});
Route::get('/assign_lawyer', function () {
    return view('assign_lawyer');
});

// Room Allocation
Route::get('/allocate_room', function () {
    return view('allocate_room');
});
Route::get('/view_room_allocations', function () {
    return view('view_room_allocations');
});

// Prison Management
Route::get('/add_prison', function () {
    return view('add_prison');
});
Route::get('/view_prison', function () {
    return view('view_prison');
});

// Visiting Time Requests
Route::get('/create_visiting_time_request', function () {
    return view('create_visiting_time_request');
});
Route::get('/view_visiting_time_requests', function () {
    return view('view_visiting_time_requests');
});
