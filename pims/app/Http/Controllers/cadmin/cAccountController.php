<?php

namespace App\Http\Controllers\cadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Backup;
use App\Models\Prison;
use App\Models\Requests;
use App\Models\Prisoner;
use App\Models\Role;
use App\Models\Visitor;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use OwenIt\Auditing\Models\Audit;
class cAccountController extends Controller
{
    // Existing methods from previous response
    public function dashboard()
    {
        try {
            // Fetch counts for dashboard cards
            $adminCount = Account::where('role_id', 1)->count();
            $prisonerCount = Prisoner::count();

            $reportCount = Report::where('created_at', '>=', now()->subMonth())
                ->count();

            $backupCount = Backup::where('backup_status', 'completed')
                ->count();

            // Fallback for pending transfers (no Transfer model)
            $pendingTransfers = Requests::where('status', 'transferred')->count(); // Adjust status as needed
            // If no suitable status exists, use: $pendingTransfers = 0;

            // Fallback for reports in progress (no status column)
            $reportsInProgress = Report::where('created_at', '>=', now()->subHours(24))
                ->count(); // Proxy for "in progress"

            // Fallback for next backup (no backup_date column)
            $nextBackup = now()->addHours(6); // Assume backups every 6 hours
            $nextBackupDiff = now()->diff($nextBackup);
            $nextBackupFormatted = $nextBackupDiff->h . 'h ' . $nextBackupDiff->i . 'm';

            // Fetch recent security events (audits)
            $activities = Audit::with('user')
                ->whereIn('event', ['created', 'updated', 'deleted', 'login', 'failed_login'])
                ->latest()
                ->take(20)
                ->get();

            // Check for unauthorized access attempts
            $unauthorizedAttempts = Audit::where('event', 'failed_login')
                ->where('created_at', '>=', now()->subHours(24))
                ->count();

            // Fetch data for chart
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
        } catch (\Exception $e) {
            Log::error('Failed to load dashboard data', ['error' => $e->getMessage()]);
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
                'data' => [
                    $prisonCount,
                    $totalPrisoners,
                    $malePrisoners,
                    $femalePrisoners,
                ],
            ];
        } catch (\Exception $e) {
            Log::error('Failed to fetch chart data', ['error' => $e->getMessage()]);
            return [
                'labels' => ['Prisons', 'Total Prisoners', 'Male Prisoners', 'Female Prisoners'],
                'data' => [0, 0, 0, 0],
            ];
        }
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

    try {
        Prison::create($validated);
        return redirect()->back()->with('success', 'Prison added successfully!');
    } catch (QueryException $e) {
        // Check for duplicate entry error (MySQL error code 1062)
        if ($e->errorInfo[1] == 1062) {
            return redirect()->back()
                ->with(['error' => 'A prison with this name already exists.']);
        }

        // Generic database error message
        return redirect()->back()
            ->withInput()
            ->withErrors(['database' => 'Failed to add prison due to a database error.']);
    }
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
                            'id' => $account->id,
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
        } catch (\Exception $e) {
            Log::error('Failed to generate report', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to generate report'], 500);
        }
    }
    public function initiateBackup(Request $request)
    {
        try {
            Log::info('Backup process initiated by user.', [
                'user_id' => session('user_id'),
            ]);

            // Create backup record (in_progress)
            $backup = Backup::create([
                'initiated_by' =>  session('user_id'),
                'backup_status' => 'completed'
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

            // Handle empty password properly
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

            // Update backup status to completed
            $backup->update(['backup_status' => 'completed']);

            Log::info('Database backup file created successfully.', ['file' => $backupFile]);

            $content = [
                'title' => 'Database Backup',
                'filename' => $backupFile,
                'generated_date' => now()->toDateTimeString(),
            ];

            Log::info('Sending backup file for download.', ['file' => $backupFile]);

            return response()->download($backupPath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            if (isset($backup)) {
                $backup->update(['backup_status' => 'failed']);
            }
            Log::error('Backup process failed.', [
                'message' => $e->getMessage(),
                'user_id' =>   session('user_id'),
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
        } catch (\Exception $e) {
            Log::error('Failed to fetch backup logs: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load backup logs');
        }
    }

    // New method to store report generation/export
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

            // Check for duplicate report within 5 seconds
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
        } catch (\Exception $e) {
            Log::error('Failed to store report', ['error' => $e->getMessage()]);
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
                    'content' => $report->content, // JSON string, not decoded
                ];
            });

            Log::info('Fetched reports for view', ['count' => $reports->count()]);

            return view('cadmin.view_reports', compact('reports'));
        } catch (\JsonException $e) {
            Log::error('JSON encoding failed in viewReports', ['error' => $e->getMessage()]);
            return view('cadmin.view_reports', ['reports' => []])->with('error', 'Failed to process report data.');
        } catch (\Exception $e) {
            Log::error('Failed to fetch reports', ['error' => $e->getMessage()]);
            return view('cadmin.view_reports', ['reports' => []])->with('error', 'Failed to load reports.');
        }
    }
    public function updateprison(Request $request, $id)
    {
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

        return back()->with('success', 'Prison updated successfully.');
    }

    public function destroyprison($id)
    {
        $prison = Prison::findOrFail($id);

        if ($prison->rooms()->exists() || $prison->prisoners()->exists()) {
            return back()->with('error', 'Cannot delete prison with associated rooms or prisoners.');
        }

        $prison->delete();
        return back()->with('success', 'Prison deleted successfully.');
    }

    public function destroyacc($user_id)
    {
        $account = Account::findOrFail($user_id);
        $account->delete();

        return back()->with('success', 'Account deleted successfully.');
    }
}
