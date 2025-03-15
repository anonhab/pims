<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\LawyerPrisonerAssignment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    // Log request received
    Log::info('Login attempt:', ['email' => $request->email, 'ip' => $request->ip()]);

    // Rate limiter key (based on IP address)
    $key = 'login-attempts:' . $request->ip();

    // Check if too many attempts
    if (RateLimiter::tooManyAttempts($key, 5)) {
        Log::warning('Too many login attempts', ['email' => $request->email, 'ip' => $request->ip()]);
        throw ValidationException::withMessages(['email' => 'Too many login attempts. Try again later.']);
    }

    // Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    $credentials = $request->only(['email', 'password']);

    // Check if the account exists
    if ($account = Account::where('email', $credentials['email'])->first()) {
        Log::info('Account found:', ['email' => $account->email]);

        // Check if password matches
        if (Hash::check($credentials['password'], $account->password)) {
            // Reset rate limiter after successful login
            RateLimiter::clear($key);

            // Store user session
            $request->session()->put([
                'username'   => $account->username,
                'user_id'    => $account->user_id,
                'first_name' => $account->first_name,
                'last_name'  => $account->last_name,
                'user_image' => $account->user_image,
                'role_id'    => is_object($account->role) ? $account->role->id : (int) $account->role, // Extract ID from Role model
                'rolename'   => is_object($account->role) ? $account->role->name : '', // Fetch role name if it's an object, else empty string
            ]);
            
            Log::info('Login successful:', ['email' => $account->email, 'username' => $account->username]);

            // Redirect based on role_id
            if ($account->role_id == 3) {
                $recentAssignments = LawyerPrisonerAssignment::all();

                return view('cadmin.dashboard',compact('recentAssignments')); // Redirect to inspector dashboard view for role_id 2
            } elseif ($account->role_id == 2) {
                return view('inspector.dashboard'); // Redirect to inspector dashboard view for role_id 2

            } else {
                return redirect()->intended('/dashboard'); // Default dashboard
            }
        } else {
            Log::warning('Login failed: Incorrect password', ['email' => $credentials['email']]);
        }
    } else {
        Log::warning('Login failed: Account not found', ['email' => $credentials['email']]);
    }

    // Increment rate limiter
    RateLimiter::hit($key, 60); // Lock for 60 seconds after 5 attempts

    return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
}

    public function homepage(Request $request)
    {
        return view('index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget([
            'username',
            'first_name',
            'user_id',
            'last_name',
            'role_id',
            'user_image',
            'rolename'
        ]);
        return redirect()->route('login');
    }
}
