<?php

namespace App\Http\Controllers\cadmin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Backup;
use App\Models\Notification;
use App\Models\Prison;
use App\Models\Prisoner;
use App\Models\Report;
use App\Models\Requests;
use App\Models\Role;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use OwenIt\Auditing\Models\Audit;

class cAccountController extends Controller
{
    public function changePassword(Request $request, $user_id)
    {
        Log::info('Password change request initiated.', [
            'requested_by' => session('user_id'),
            'target_account_id' => $user_id,
            'timestamp' => now()->toDateTimeString(),
            'ip_address' => $request->ip(),
        ]);
    
       
        Log::info('Password validation passed.', [
            'account_id' => $user_id,
            'timestamp' => now()->toDateTimeString(),
        ]);
    
        try {
            $account = Account::findOrFail($user_id);
            $account->password = Hash::make($request->new_password);
            $account->save();
    
            Log::info('Password successfully updated.', [
                'account_id' => $account->id,
                'timestamp' => now()->toDateTimeString(),
                'updated_by' => session('user_id')
            ]);
    
            return redirect()->back()->with('success', 'Password updated successfully.');
        } catch (\Exception $e) {
            Log::error('Password update failed.', [
                'account_id' => $user_id,
                'error_message' => $e->getMessage(),
                'timestamp' => now()->toDateTimeString(),
            ]);
    
            return redirect()->back()->with('error', 'Failed to update password.');
        }
    }
    public function dashboard()
    {
        try {
            $adminCount = Account::where('role_id', 1)->count();
            $prisonerCount = Prisoner::count();
            $reportCount = Report::where('created_at', '>=', now()->subMonth())->count();
            $backupCount = Backup::where('backup_status', 'completed')->count();
            $pendingTransfers = Requests::where('status', 'transferred')->count();
            $reportsInProgress = Report::where('created_at', '>=', now()->subHours(24))->count();

            $nextBackup = now()->addHours(6);
            $nextBackupDiff = now()->diff($nextBackup);
            $nextBackupFormatted = $nextBackupDiff->h . 'h ' . $nextBackupDiff->i . 'm';

            $activities = Audit::with('user')
                ->whereIn('event', ['created', 'updated', 'deleted', 'login', 'failed_login'])
                ->latest()
                ->take(20)
                ->get();

            $unauthorizedAttempts = Audit::where('event', 'failed_login')
                ->where('created_at', '>=', now()->subHours(24))
                ->count();

            $chartData = $this->getChartData();

            return view('cadmin.dashboard', compact(
                'adminCount',
                'prisonerCount',
                'reportCount',
                'backupCount',
                'pendingTransfers',
                'reportsInProgress',
                'nextBackupFormatted',
                'activities',
                'unauthorizedAttempts',
                'chartData'
            ));
        } catch (QueryException $e) {
            Log::error('Database error in dashboard', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load dashboard data due to a database error');
        } catch (\Exception $e) {
            Log::error('Failed to load dashboard data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load dashboard data');
        }
    }

    public function getChartData()
    {
        try {
            $prisonCount = Prison::count();
            $totalPrisoners = Prisoner::count();
            $malePrisoners = Prisoner::where('gender', 'male')->count();
            $femalePrisoners = Prisoner::where('gender', 'female')->count();

            return [
                'labels' => ['Prisons', 'Total Prisoners', 'Male Prisoners', 'Female Prisoners'],
                'data' => [$prisonCount, $totalPrisoners, $malePrisoners, $femalePrisoners],
            ];
        } catch (QueryException $e) {
            Log::error('Database error in getChartData', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return [
                'labels' => ['Prisons', 'Total Prisoners', 'Male Prisoners', 'Female Prisoners'],
                'data' => [0, 0, 0, 0],
            ];
        } catch (\Exception $e) {
            Log::error('Failed to fetch chart data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return [
                'labels' => ['Prisons', 'Total Prisoners', 'Male Prisoners', 'Female Prisoners'],
                'data' => [0, 0, 0, 0],
            ];
        }
    }

    public function generate()
    {
        try {
            return view('cadmin.generate');
        } catch (\Exception $e) {
            Log::error('Failed to load generate view', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load report generation page');
        }
    }

    public function prisonadd()
    {
        try {
            return view('cadmin.add_prison');
        } catch (\Exception $e) {
            Log::error('Failed to load add prison view', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load add prison page');
        }
    }

    public function prisonassign()
    {
        try {
            $prison = Prison::all();
            return view('cadmin.assign_prison', compact('prison'));
        } catch (QueryException $e) {
            Log::error('Database error in prisonassign', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load prison assignment page due to a database error');
        } catch (\Exception $e) {
            Log::error('Failed to load prison assign page', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load prison assignment page');
        }
    }

    public function prisonview()
    {
        try {
            $prisons = Prison::paginate(25);
            return view('cadmin.view_prison', compact('prisons'));
        } catch (QueryException $e) {
            Log::error('Database error in prisonview', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load prisons due to a database error');
        } catch (\Exception $e) {
            Log::error('Failed to load prisons view', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load prisons');
        }
    }

    public function show_all()
    {
        try {
            $roles = Role::all();
            $accounts = Account::with('role')->paginate(10);
            return view('cadmin.view_accounts', compact('accounts', 'roles'));
        } catch (QueryException $e) {
            Log::error('Database error in show_all', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load accounts due to a database error');
        } catch (\Exception $e) {
            Log::error('Failed to load accounts view', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load accounts');
        }
    }

    public function prisonstore(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|unique:prisons,name',
                'location' => 'required',
                'capacity' => 'required|integer|min:1',
            ]);
    
            Prison::create($validated);
    
            return redirect()->back()->with('success', 'Prison created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in prisonstore', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                             ->withErrors($e->validator)
                             ->withInput();
        } catch (QueryException $e) {
            Log::error('Database error in prisonstore', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                             ->with('error', 'A database error occurred while creating the prison.')
                             ->withInput();
        } catch (\Exception $e) {
            Log::error('Unexpected error in prisonstore', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                             ->with('error', 'An unexpected error occurred.')
                             ->withInput();
        }
    }
    

    public function show_prisoners()
    {
        try {
            $prisoners = Prisoner::paginate(9);
            return view('cadmin.view_prisoners', compact('prisoners'));
        } catch (QueryException $e) {
            Log::error('Database error in show_prisoners', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load prisoners due to a database error');
        } catch (\Exception $e) {
            Log::error('Failed to load prisoners view', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load prisoners');
        }
    }

    public function all()
    {
        try {
            $accounts = Account::all();
            return view('cadmin.view_account', compact('accounts'));
        } catch (QueryException $e) {
            Log::error('Database error in all', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load accounts due to a database error');
        } catch (\Exception $e) {
            Log::error('Failed to load accounts view', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load accounts');
        }
    }

    public function add_prison()
    {
        try {
            return view('cadmin.add_prison');
        } catch (\Exception $e) {
            Log::error('Failed to load add prison view', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load add prison page');
        }
    }

    public function view_prison()
    {
        try {
            return view('cadmin.view_prison');
        } catch (\Exception $e) {
            Log::error('Failed to load view prison page', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load prison view page');
        }
    }

    public function view_requests()
    {
        try {
            $requests = Requests::paginate(9);
            $roles = Role::all();
            return view('inspector.view_requests', compact('requests', 'roles'));
        } catch (QueryException $e) {
            Log::error('Database error in view_requests', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load requests due to a database error');
        } catch (\Exception $e) {
            Log::error('Failed to load requests view', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load requests');
        }
    }

    public function account_add()
    {
        try {
            $account = Account::all();
            $prisons = Prison::all();
            $roles = Role::where('id', 1)->get();
            return view('cadmin.create_account', compact('account', 'prisons', 'roles'));
        } catch (QueryException $e) {
            Log::error('Database error in account_add', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load account creation page due to a database error');
        } catch (\Exception $e) {
            Log::error('Failed to load account creation page', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load account creation page');
        }
    }
    private function createNotification($recipientId, $recipientRole, $roleId, $relatedTable, $relatedId, $title, $message, $prisonId)
    {
        Notification::create([
            'recipient_id' => $recipientId,
            'recipient_role' => $recipientRole,
            'role_id' => $roleId,
            'related_table' => $relatedTable,
            'related_id' => $relatedId,
            'title' => $title,
            'message' => $message,
            'is_read' => false,
            'prison_id' => $prisonId,
        ]);
    }

    public function store(Request $request)
{
    Log::info('User registration attempt', ['username' => $request->username]);
    
    try {
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

        $user = null;
        DB::transaction(function () use ($request, $imagePath, &$user) {
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

        // Create notification for admin
        $this->createNotification(
            session('user_id'), // Admin ID (or get from session)
            1, // Admin role
            session('role_id'),
            'accounts',
            $request->id,
            'New User Registration',
            'A new user ' . $request->username . ' has been registered',
            session('prison_id')
        );

        Session::flash('success', 'User registered successfully!');
        return redirect()->back();
    } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in store', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            Session::flash('error', 'Invalid input data. Please check the form.');
            return redirect()->back();
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                Log::error('Duplicate entry error in store', ['error' => $e->getMessage()]);
                Session::flash('error', 'Duplicate entry: Email or username already exists.');
                return redirect()->back();
            }
            Log::error('Database error in store', ['error' => $e->getMessage()]);
            Session::flash('error', 'A database error occurred. Please try again.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Unexpected error in store', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            Session::flash('error', 'An unexpected error occurred. Please try again.');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $account = Account::findOrFail($id);
            $account->first_name = $request->first_name;
            $account->last_name = $request->last_name;
            $account->email = $request->email;
            $account->phone_number = $request->phone_number;
            $account->role_id = $request->role_id;
            $account->save();
            
            return redirect()->back()->with('success', 'User updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in update', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Invalid input data. Please check the form.');
        } catch (QueryException $e) {
            Log::error('Database error in update', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Database error occurred while updating the account');
        } catch (\Exception $e) {
            Log::error('Unexpected error in update', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'An unexpected error occurred while updating the account');
        }
    }

    public function destroy($id)
    {
        try {
            $account = Account::find($id);
            if (!$account) {
                return response()->json(['success' => false, 'message' => 'Account not found'], 404);
            }
            $account->delete();
            return redirect()->back()->with('success', 'User deleted successfully!');
        } catch (QueryException $e) {
            Log::error('Database error in destroy', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Database error occurred while deleting the account');
        } catch (\Exception $e) {
            Log::error('Unexpected error in destroy', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'An unexpected error occurred while deleting the account');
        }
    }

    public function getPrisons()
    {
        try {
            $prisons = Prison::all()->map(fn($prison) => [
                'id' => $prison->id,
                'name' => $prison->name,
                'location' => $prison->location,
                'capacity' => $prison->capacity,
                'status' => 'Operational',
            ]);
            
            Log::info('Fetched prisons', ['count' => $prisons->count()]);
            return response()->json($prisons);
        } catch (QueryException $e) {
            Log::error('Database error in getPrisons', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Database error occurred while fetching prisons'], 500);
        } catch (\Exception $e) {
            Log::error('Failed to fetch prisons', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
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
                            'id' => $account->user_id,
                            'name' => $account->first_name . ' ' . $account->last_name,
                            'role' => $account->role ? $account->role->name : 'Unknown',
                            'status' => 'Active',
                            'prison' => $account->prison ? $account->prison->name : null,
                        ]),
                        'prisoners' => $prisoners->map(fn($prisoner) => [
                            'id' => $prisoner->id,
                            'name' => $prisoner->name,
                            'sentence' => $prisoner->sentence ?? 'Unknown',
                            'status' => $prisoner->status ?? 'Incarcerated',
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
                            'id' => $account->user_id,
                            'name' => $account->first_name . ' ' . $account->last_name,
                            'role' => $account->role ? $account->role->name : 'Unknown',
                            'status' => 'Active',
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
                            'name' => $prisoner->first_name . ' ' . $prisoner->middle_name . ' ' . $prisoner->last_name,
                            'sentence' => ($prisoner->time_serve_start && $prisoner->time_serve_end)
                                ? Carbon::parse($prisoner->time_serve_start)->diff(Carbon::parse($prisoner->time_serve_end))->format('%y years, %m months')
                                : 'Unknown',
                            'status' => $prisoner->status ?? 'Incarcerated',
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
                            'status' => 'Operational',
                        ])
                    );

                default:
                    return response()->json(['error' => 'Invalid report type'], 400);
            }
        } catch (QueryException $e) {
            Log::error('Database error in generateReport', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Database error occurred while generating report'], 500);
        } catch (\Exception $e) {
            Log::error('Failed to generate report', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Failed to generate report'], 500);
        }
    }

    public function initiateBackup(Request $request)
    {
        try {
            Log::info('Backup process initiated by user.', [
                'user_id' => session('user_id'),
            ]);

            $backup = Backup::create([
                'initiated_by' => session('user_id'),
                'backup_status' => 'in_progress'
            ]);

            $backupFile = 'backup_' . date('Ymd_His') . '.sql';
            $backupDir = storage_path('app/backups');
            $backupPath = $backupDir . '/' . $backupFile;

            if (!file_exists($backupDir)) {
                mkdir($backupDir, 0755, true);
                Log::info('Backup directory created.', ['path' => $backupDir]);
            }

            $db = config('database.connections.mysql');
            $username = escapeshellarg($db['username'] ?? 'root');
            $password = $db['password'] ?? '';
            $host = escapeshellarg($db['host'] ?? '127.0.0.1');
            $database = escapeshellarg($db['database'] ?? 'your_database_name');

            $passwordPart = $password !== '' ? "-p" . escapeshellarg($password) : '';

            $command = "mysqldump -u {$username} {$passwordPart} -h {$host} {$database} > {$backupPath}";
            Log::info('Executing mysqldump command.', ['command' => $command]);

            exec($command, $output, $returnVar);

            if ($returnVar !== 0 || !file_exists($backupPath)) {
                $backup->update(['backup_status' => 'failed']);
                Log::error('mysqldump failed.', [
                    'return_code' => $returnVar,
                    'output' => $output
                ]);
                throw new \Exception('Backup failed. Please check mysqldump access and permissions.');
            }

            $backup->update(['backup_status' => 'completed']);

            Log::info('Database backup file created successfully.', ['file' => $backupFile]);

            $content = [
                'title' => 'Database Backup',
                'filename' => $backupFile,
                'generated_date' => now()->toDateTimeString(),
            ];

            Log::info('Sending backup file for download.', ['file' => $backupFile]);

            return response()->download($backupPath)->deleteFileAfterSend(true);
        } catch (QueryException $e) {
            if (isset($backup)) {
                $backup->update(['backup_status' => 'failed']);
            }
            Log::error('Database error in initiateBackup', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => session('user_id')
            ]);
            return response()->json(['error' => 'Database error occurred during backup'], 500);
        } catch (\Exception $e) {
            if (isset($backup)) {
                $backup->update(['backup_status' => 'failed']);
            }
            Log::error('Backup process failed.', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => session('user_id')
            ]);
            return response()->json(['error' => 'Backup failed: ' . $e->getMessage()], 500);
        }
    }

    public function viewBackupLogs()
    {
        try {
            $backups = Backup::leftJoin('users', 'backups.initiated_by', '=', 'users.id')
                ->select('backups.id', 'users.name as initiated_by', 'backups.backup_date', 'backups.backup_status')
                ->orderBy('backups.backup_date', 'desc')
                ->get();

            return view('cadmin.view_backup_logs', compact('backups'));
        } catch (QueryException $e) {
            Log::error('Database error in viewBackupLogs', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load backup logs due to a database error');
        } catch (\Exception $e) {
            Log::error('Failed to fetch backup logs', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load backup logs');
        }
    }

    public function storeReport(Request $request)
    {
        try {
            $request->validate([
                'report_type' => 'required|in:All Accounts,Staff,Prisoners,All Prisons',
                'content' => 'required|json',
            ]);

            $generatedBy = session('user_id');
            $reportType = $request->report_type;
            $content = $request->content;

            $recentReport = Report::where('generated_by', $generatedBy)
                ->where('report_type', $reportType)
                ->where('content', $content)
                ->where('created_at', '>=', now()->subSeconds(5))
                ->first();

            if ($recentReport) {
                Log::warning('Duplicate report detected, skipping storage', [
                    'generated_by' => $generatedBy,
                    'report_type' => $reportType,
                    'content' => $content,
                ]);
                return response()->json(['success' => true, 'id' => $recentReport->id], 200);
            }

            $report = Report::create([
                'generated_by' => $generatedBy,
                'report_type' => $reportType,
                'content' => $content,
            ]);

            Log::info('Report stored successfully', [
                'id' => $report->id,
                'generated_by' => $report->generated_by,
                'report_type' => $report->report_type,
            ]);

            return response()->json(['success' => true, 'id' => $report->id], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in storeReport', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->errors()], 422);
        } catch (QueryException $e) {
            Log::error('Database error in storeReport', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Database error occurred while storing report'], 500);
        } catch (\Exception $e) {
            Log::error('Failed to store report', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Failed to store report'], 500);
        }
    }

    public function viewReports()
    {
        try {
            $reports = Report::with('user')->get()->map(function ($report) {
                return [
                    'id' => $report->id,
                    'generated_by' => $report->user ? $report->user->first_name . ' ' . $report->user->last_name : ($report->generated_by ?? 'Unknown'),
                    'report_type' => ucfirst($report->report_type),
                    'created_at' => $report->created_at->format('M d, Y H:i:s'),
                    'content' => $report->content,
                ];
            });

            Log::info('Fetched reports for view', ['count' => $reports->count()]);

            return view('cadmin.view_reports', compact('reports'));
        } catch (\JsonException $e) {
            Log::error('JSON encoding failed in viewReports', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return view('cadmin.view_reports', ['reports' => []])->with('error', 'Failed to process report data');
        } catch (QueryException $e) {
            Log::error('Database error in viewReports', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return view('cadmin.view_reports', ['reports' => []])->with('error', 'Failed to load reports due to a database error');
        } catch (\Exception $e) {
            Log::error('Failed to fetch reports', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return view('cadmin.view_reports', ['reports' => []])->with('error', 'Failed to load reports');
        }
    }

    public function updateprison(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:prisons,name,' . $id,
                'location' => 'required|string|max:255',
                'capacity' => 'required|integer|min:1',
            ]);

            if ($validator->fails()) {
                return back()->with('error', $validator->errors()->first());
            }

            $prison = Prison::findOrFail($id);
            $prison->update($request->only(['name', 'location', 'capacity']));

            return back()->with('success', 'Prison updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in updateprison', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Invalid input data');
        } catch (QueryException $e) {
            Log::error('Database error in updateprison', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Database error occurred');
        } catch (\Exception $e) {
            Log::error('Unexpected error in updateprison', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Unexpected error occurred');
        }
    }

    public function destroyprison($id)
    {
        try {
            $prison = Prison::findOrFail($id);

            if ($prison->rooms()->exists() || $prison->prisoners()->exists()) {
                return redirect()->back()->with('error', 'Cannot delete prison with associated rooms or rooms');
            }

            $prison->delete();
            return redirect()->back()->with('success', 'Prison deleted successfully');
        } catch (QueryException $e) {
            Log::error('Database error in destroyprison', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Database error occurred while deleting the prison');
        } catch (\Exception $e) {
            Log::error('Unexpected error in destroyprison', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'An unexpected error occurred while deleting the prison');
        }
    }

    public function destroyacc($user_id)
    {
        try {
            $account = Account::findOrFail($user_id);
            $account->delete();

            return redirect()->back()->with('success', 'Account deleted successfully');
        } catch (QueryException $e) {
            Log::error('Database error in destroyacc', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Database error occurred while deleting the account');
        } catch (\Exception $e) {
            Log::error('Unexpected error in destroyacc', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'An unexpected error occurred while deleting the account');
        }
    }
}