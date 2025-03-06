<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cadmin\cAccountController;
use App\Http\Controllers\sysadmin\sAccountController;
use App\Http\Controllers\inspector\iPrisonerController;
use App\Http\Controllers\Lawyer\myLawyerController;

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
// API Routes
Route::get('/prisoner/{id}', [iPrisonerController::class, 'show']);  // Show individual prisoner details

