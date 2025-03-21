<?php

namespace App\Http\Controllers\Auth;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
      
        // Validate input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        // Fetch the logged-in user
        $account = Account::find(session('user_id')); // Ensure session stores the user ID

        if (!$account) {
            return back()->withErrors(['error' => 'User not found.']);
        }

        // Verify the current password
        if (!Hash::check($request->current_password, $account->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the password
        $account->password = Hash::make($request->new_password);
        $account->save(); // 🔥 Now this will work

        // Update the session password
        session()->put('password', $account->password);

        return back()->with('success', 'Password updated successfully!');
    }
}
