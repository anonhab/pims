<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Lawyer;
use App\Models\Prison;
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
        // Log request attempt
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

        // Check if user exists in the Account model
        if ($account = Account::where('email', $credentials['email'])->first()) {
            Log::info('Account found:', ['email' => $account->email]);

            // Verify password
            if (Hash::check($credentials['password'], $account->password)) {
                // Reset rate limiter
                RateLimiter::clear($key);

                // Store session data
                $request->session()->put([
                    'username'   => $account->username,
                    'user_id'    => $account->user_id,
                    'prison'     => $account->prison ? $account->prison->name : 'N/A',
                    'email'      => $account->email,
                    'gender'     => $account->gender,
                    'address'    => $account->address,
                    'phone'      => $account->phone_number,
                    'first_name' => $account->first_name,
                    'last_name'  => $account->last_name,
                    'user_image' => $account->user_image,
                    'prison_id'  => $account->prison_id,
                    'role_id'    => is_object($account->role) ? $account->role->id : (int) $account->role,
                    'rolename'   => is_object($account->role) ? $account->role->name : '',
                    'password'   => $account->password, // Ensure this is hashed
                ]);

                Log::info('Login successful:', ['email' => $account->email, 'username' => $account->username]);

                // Redirect based on role
                return match ($account->role_id) {
                    3 => view('cadmin.dashboard', ['recentAssignments' => LawyerPrisonerAssignment::all()]),
                    2 => view('inspector.dashboard'),
                    1 => view('sysadmin.dashboard', ['recentAssignments' => LawyerPrisonerAssignment::all()]),
                    8 => view('police_officer.dashboard'),
                    6  => view('training_officer.dashboard'),
                    default => redirect()->intended('/dashboard'),
                };
            } else {
                Log::warning('Login failed: Incorrect password', ['email' => $credentials['email']]);
            }
        }

        // Check if user is a lawyer
        elseif ($lawyer = Lawyer::where('email', $credentials['email'])->first()) {
            Log::info('Lawyer account found:', ['email' => $lawyer->email]);

            // Verify password
            if (Hash::check($credentials['password'], $lawyer->password)) {
                // Reset rate limiter
                RateLimiter::clear($key);

                // Store session data
                $request->session()->put([
                    'lawyer_id'      => $lawyer->lawyer_id,
                    'first_name'     => $lawyer->first_name,
                    'last_name'      => $lawyer->last_name,
                    'date_of_birth'  => $lawyer->date_of_birth,
                    'contact_info'   => $lawyer->contact_info,
                    'email'          => $lawyer->email,
                    'law_firm'       => $lawyer->law_firm,
                    'license_number' => $lawyer->license_number,
                    'cases_handled'  => $lawyer->cases_handled,
                    'prison_id'         => $lawyer->prison,
                    'user_image' => $lawyer->profile_image,
              
                    'prison' => Prison::find($lawyer->prison)?->name,


                    
                ]);

                // If lawyer_id is set, add 'rolename' => 'lawyer' to the session
                if ($request->session()->has('lawyer_id')) {
                    $request->session()->put('rolename', 'lawyer');
                }

                Log::info('Lawyer login successful:', ['email' => $lawyer->email, 'username' => $lawyer->username]);

                return view('lawyer.dashboard');
            } else {
                Log::warning('Lawyer login failed: Incorrect password', ['email' => $credentials['email']]);
            }
        } else {
            Log::warning('Login failed: Account not found', ['email' => $credentials['email']]);
        }

        // Increment rate limiter
        RateLimiter::hit($key, 60);

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
            'lawyer_id',
            'prison',
            'first_name',
            'user_id',
            'last_name',
            'role_id',
            'user_image',
            'rolename',
            'email',
            'gender',
            'address',
            'phone',
        ]);
        $request->session()->forget([
            'lawyer_id',
            'first_name',
            'last_name',
            'date_of_birth',
            'contact_info',
            'email',
            'law_firm',
            'license_number',
            'cases_handled',
            'prison',
        ]);
        return redirect()->route('login');
    }
}
