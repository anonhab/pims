<?php

namespace App\Http\Controllers\Auth;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Lawyer;
use App\Models\Visitor;
use Illuminate\Support\Facades\Log;

class PasswordController extends Controller
{
    public function update(Request $request)
{
    // Validate input
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $account = null;
    $accountType = null;

    // Identify and fetch the logged-in user
    if (session()->has('user_id')) {
        $account = Account::find(session('user_id'));
        $accountType = 'Account';
    } elseif (session()->has('lawyer_id')) {
        $account = Lawyer::find(session('lawyer_id'));
        $accountType = 'Lawyer';
    } elseif (session()->has('visitor_id')) {
        $account = Visitor::find(session('visitor_id'));
        $accountType = 'Visitor';
    }

    // Handle missing account
    if (!$account) {
        Log::warning('Password update failed: No account found in session.');
        return back()->withErrors(['error' => 'Account not found.']);
    }

    // Verify current password
    if (!Hash::check($request->current_password, $account->password)) {
        Log::warning("Password update failed: Incorrect current password for $accountType ID {$account->id}");
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    // Update password
    $account->password = Hash::make($request->new_password);
    $account->save();

    Log::info("Password updated for $accountType ID {$account->id}");

    // Clear session to force re-login
    session()->flush();

    // Redirect to login page with success message
    return redirect()->route(route: 'login')->with('success', 'Password updated successfully. Please log in again.');
}
}
