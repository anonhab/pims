<?php

namespace App\Http\Controllers\cadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Prison;
use App\Models\Requests;
use App\Models\Prisoner;
use App\Models\Role;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class cAccountController extends Controller
{
    // Show all accounts
    public function getChartData()
    {
        $startDate = Carbon::now()->subDays(7);
        $chartData = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i)->format('Y-m-d');
            $chartData[] = [
                'date' => $date,
                'visitors' => Visitor::whereDate('created_at', $date)->count(),
                'prisoners' => Prisoner::whereDate('created_at', $date)->count(),
                'prisons' => Prison::count(),
                'staffs' => Account::whereDate('created_at', $date)->count(),
            ];
        }
        return response()->json($chartData);
    }

    public function dashboard()
    {
        return view('cadmin.dashboard');
    }

    public function generate()
    {
        return view('cadmin.generate');
    }

    public function prisonadd()
    {
        return view('cadmin.add_prison');
    }

    public function prisonassign()
    {
        $prison = Prison::all();
        return view('cadmin.assign_prison', compact('prison'));
    }

    public function prisonview()
    {
        $prisons = Prison::paginate(25);
        return view('cadmin.view_prison', compact('prisons'));
    }

    public function show_all()
    {
        $roles = Role::all();
        $accounts = Account::with('role')->paginate(10);
        return view('cadmin.view_accounts', compact('accounts', 'roles'));
    }

    public function prisonstore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);
        Prison::create($validated);
        return redirect()->back()->with('success', 'Prison added successfully!');
    }

    public function show_prisoners()
    {
        $prisoners = Prisoner::paginate(9);
        return view('cadmin.view_prisoners', compact('prisoners'));
    }

    public function all()
    {
        $accounts = Account::all();
        return view('cadmin.view_account', compact('accounts'));
    }

    public function add_prison()
    {
        return view('cadmin.add_prison');
    }

    public function view_prison()
    {
        return view('cadmin.view_prison');
    }

    public function view_requests()
    {
        $requests = Requests::paginate(9);
        $roles = Role::all();
        return view('inspector.view_requests', compact('requests', 'roles'));
    }

    public function account_add()
    {
        $account = Account::all();
        $prisons = Prison::all();
        $roles = Role::where('id', 1)->get();
        return view('cadmin.create_account', compact('account', 'prisons', 'roles'));
    }

    public function store(Request $request)
    {
        Log::info('User registration attempt', ['username' => $request->username]);
        if (Account::where('username', $request->username)->exists()) {
            Session::flash('error', 'Username already exists. Please choose a different one.');
            return redirect()->back();
        }
        $imagePath = null;
        if ($request->hasFile('user_image')) {
            try {
                $imagePath = $request->file('user_image')->store('user_images', 'public');
                Log::info('User image uploaded successfully.', ['image_path' => $imagePath]);
            } catch (\Exception $e) {
                Log::error('Image upload failed', ['error' => $e->getMessage()]);
                Session::flash('error', 'Image upload failed.');
                return redirect()->back();
            }
        }
        try {
            DB::transaction(function () use ($request, $imagePath) {
                $user = Account::create([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'role_id' => $request->role_id,
                    'prison_id' => $request->prison_id ?? null,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number ?? null,
                    'dob' => $request->dob ?? null,
                    'gender' => $request->gender,
                    'address' => $request->address ?? null,
                    'user_image' => $imagePath,
                ]);
                Log::info('User created successfully', ['id' => $user->user_id, 'username' => $user->username]);
            });
            Session::flash('success', 'User registered successfully!');
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                Log::error('Duplicate entry error', ['error' => $e->getMessage()]);
                Session::flash('error', 'Duplicate entry: Email or username already exists.');
                return redirect()->back();
            }
            Log::error('Database error', ['error' => $e->getMessage()]);
            Session::flash('error', 'A database error occurred. Please try again.');
            return redirect()->back();
        } catch (\Throwable $e) {
            Log::error('Unexpected error', ['error' => $e->getMessage()]);
            Session::flash('error', 'An unexpected error occurred. Please try again.');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);
        $account->first_name = $request->first_name;
        $account->last_name = $request->last_name;
        $account->email = $request->email;
        $account->phone_number = $request->phone_number;
        $account->role_id = $request->role_id;
        $account->save();
        return redirect()->back()->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['success' => false, 'message' => 'Account not found'], 404);
        }
        $account->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    // Web route methods
    public function getPrisons()
    {
        try {
            $prisons = Prison::all()->map(fn($prison) => [
                'id' => $prison->id,
                'name' => $prison->name,
                'location' => $prison->location,
                'capacity' => $prison->capacity,
                'status' => 'Operational', // Hardcoded, adjust if status field exists
            ]);
            Log::info('Fetched prisons', ['count' => $prisons->count()]);
            return response()->json($prisons);
        } catch (\Exception $e) {
            Log::error('Failed to fetch prisons', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to fetch prisons'], 500);
        }
    }

    public function generateReport(Request $request)
    {
        try {
            $prisonIds = $request->query('prison_ids', []) ? explode(',', $request->query('prison_ids')) : [];
            $reportType = $request->query('report_type', 'all_accounts');

            Log::info('Generating report', ['report_type' => $reportType, 'prison_ids' => $prisonIds]);

            switch ($reportType) {
                case 'all_accounts':
                    $accounts = Account::query()
                        ->when($prisonIds, fn($query) => $query->whereIn('prison_id', $prisonIds))
                        ->with(['prison', 'role'])
                        ->get();

                    $prisoners = Prisoner::query()
                        ->when($prisonIds, fn($query) => $query->whereIn('prison_id', $prisonIds))
                        ->with('prison')
                        ->get();

                    return response()->json([
                        'staff' => $accounts->map(fn($account) => [
                            'id' => $account->id,
                            'name' => $account->first_name . ' ' . $account->last_name,
                            'role' => $account->role ? $account->role->name : 'Unknown',
                            'status' => 'Active', // Hardcoded, adjust if status field exists
                            'prison' => $account->prison ? $account->prison->name : null,
                        ]),
                        'prisoners' => $prisoners->map(fn($prisoner) => [
                            'id' => $prisoner->id,
                            'name' => $prisoner->name,
                            'sentence' => $prisoner->sentence ?? 'Unknown',
                            'status' => $prisoner->status ?? 'Incarcerated', // Adjust if status field exists
                            'prison' => $prisoner->prison ? $prisoner->prison->name : null,
                        ]),
                    ]);

                case 'staff':
                    $accounts = Account::query()
                        ->when($prisonIds, fn($query) => $query->whereIn('prison_id', $prisonIds))
                        ->with(['prison', 'role'])
                        ->get();

                    return response()->json(
                        $accounts->map(fn($account) => [
                            'id' => $account->id,
                            'name' => $account->first_name . ' ' . $account->last_name,
                            'role' => $account->role ? $account->role->name : 'Unknown',
                            'status' => 'Active', // Hardcoded, adjust if status field exists
                            'prison' => $account->prison ? $account->prison->name : null,
                        ])
                    );

                case 'prisoners':
                    $prisoners = Prisoner::query()
                        ->when($prisonIds, fn($query) => $query->whereIn('prison_id', $prisonIds))
                        ->with('prison')
                        ->get();

                    return response()->json(
                        $prisoners->map(fn($prisoner) => [
                            'id' => $prisoner->id,
                            'name' => $prisoner->first_name,
'sentence' => ($prisoner->time_serve_start && $prisoner->time_serve_end)
    ? Carbon::parse($prisoner->time_serve_start)->diff(Carbon::parse($prisoner->time_serve_end))->format('%y years, %m months')
    : 'Unknown',                            'status' => $prisoner->status ?? 'Incarcerated', // Adjust if status field exists
                            'prison' => $prisoner->prison ? $prisoner->prison->name : null,
                        ])
                    );

                case 'all_prisons':
                    $prisons = Prison::query()
                        ->when($prisonIds, fn($query) => $query->whereIn('id', $prisonIds))
                        ->get();

                    return response()->json(
                        $prisons->map(fn($prison) => [
                            'id' => $prison->id,
                            'name' => $prison->name,
                            'location' => $prison->location,
                            'capacity' => $prison->capacity,
                            'status' => 'Operational', // Hardcoded, adjust if status field exists
                        ])
                    );

                default:
                    return response()->json(['error' => 'Invalid report type'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Failed to generate report', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to generate report'], 500);
        }
    }
}