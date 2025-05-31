<?php
  namespace App\Http\Controllers\sysadmin;

  use App\Http\Controllers\Controller;
  use App\Models\Account;
  use App\Models\Backup;
  use App\Models\Prison;
  use App\Models\Prisoner;
  use App\Models\Report;
use App\Models\Requests;
use App\Models\Role;
  use Carbon\Carbon;
  use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

  class sAccountController extends Controller
  {
    public function dashboard()
{
    try {
        $prisonId = session('prison_id'); // Get prison_id from session

$adminCount = Account::when($prisonId, function ($query) use ($prisonId) {
    return $query->where('prison_id', $prisonId);
})->count();


        $prisonerCount = Prisoner::when($prisonId, function($query) use ($prisonId) {
            return $query->where('prison_id', $prisonId);
        })->count();

        $reportCount = Report::when($prisonId, function($query) use ($prisonId) {
            return $query->where('prison_id', $prisonId);
        })->where('created_at', '>=', now()->subMonth())
          ->count();

        $backupCount = Backup::when($prisonId, function($query) use ($prisonId) {
            return $query->where('prison_id', $prisonId);
        })->where('backup_status', 'completed')->count();

        $pendingTransfers = Requests::when($prisonId, function($query) use ($prisonId) {
            return $query->where('prison_id', $prisonId);
        })->where('status', 'transferred')->count();

        $reportsInProgress = Report::when($prisonId, function($query) use ($prisonId) {
            return $query->where('prison_id', $prisonId);
        })->where('created_at', '>=', now()->subHours(24))
          ->count();

        $nextBackup = now()->addHours(6);
        $nextBackupDiff = now()->diff($nextBackup);
        $nextBackupFormatted = $nextBackupDiff->h . 'h ' . $nextBackupDiff->i . 'm';


        $chartData = $this->getChartData($prisonId);

        return view('sysadmin.dashboard', compact(
            'adminCount',
            'prisonerCount',
            'reportCount',
            'backupCount',
            'pendingTransfers',
            'reportsInProgress',
            'nextBackupFormatted',
            'chartData'
        ));
    } catch (\Exception $e) {
        Log::error('Failed to load dashboard data', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Failed to load dashboard data');
    }
}

public function getChartData($prisonId = null)
{
    try {
      
        $totalPrisoners = Prisoner::when($prisonId, function($query) use ($prisonId) {
            return $query->where('prison_id', $prisonId);
        })->count();

        $malePrisoners = Prisoner::when($prisonId, function($query) use ($prisonId) {
            return $query->where('prison_id', $prisonId);
        })->where('gender', 'male')->count();

        $femalePrisoners = Prisoner::when($prisonId, function($query) use ($prisonId) {
            return $query->where('prison_id', $prisonId);
        })->where('gender', 'female')->count();

        return [
            'labels' => [ 'Total Prisoners', 'Male Prisoners', 'Female Prisoners'],
            'data' => [
               
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

      public function show_all()
      {
          $prisons = prison::all();
          
          $roles = Role::all();
          $accounts = Account::whereNotIn('role_id', [1, 3])
              ->where('prison_id', session('prison_id'))
              ->paginate(9);
          return view('sysadmin.view_account', compact('accounts', 'prisons','roles'));
      }

      public function account_add()
      {
          $account = Account::all();
          $prisons = Prison::all();
          $roles = Role::whereNotIn('id', [1, 3,4])->get();
          return view('sysadmin.create_account', compact('account', 'prisons', 'roles'));
      }

      public function store(Request $request)
      {
          Log::info('User registration attempt', ['username' => $request->username]);

          $imagePath = null;
          if ($request->hasFile('user_image')) {
              $imagePath = $request->file('user_image')->store('user_images', 'public');
              Log::info('user image uploaded successfully.', ['image_path' => $imagePath]);
          } else {
              Log::warning('No user image uploaded.');
          }

          try {
              $user = Account::create([
                  'username' => $request->username,
                  'password' => bcrypt($request->password),
                  'role_id' => $request->role_id,
                  'prison_id' => $request->prison_id,
                  'first_name' => $request->first_name,
                  'last_name' => $request->last_name,
                  'email' => $request->email,
                  'phone_number' => $request->phone_number,
                  'dob' => $request->dob,
                  'gender' => $request->gender,
                  'address' => $request->address,
                  'user_image' => $imagePath,
              ]);

              Log::info('User created successfully', ['id' => $user->id, 'username' => $user->username]);
              session()->flash('success1', 'User registered successfully!');
              return redirect()->back()->with('success1', 'User registered successfully!');
          } catch (\Exception $e) {
              Log::error('User registration failed', ['error' => $e->getMessage()]);
              session()->flash('error1', 'Failed to register user.');
              return redirect()->back()->with('error1', 'Failed to register user.');
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
              $prisonId = session('prison_id');
              if (!$prisonId) {
                  Log::warning('No prison_id in session');
                  return response()->json(['error' => 'No prison assigned'], 403);
              }

              $prison = Prison::findOrFail($prisonId);
              $prisonData = [
                  'id' => $prison->id,
                  'name' => $prison->name,
                  'location' => $prison->location,
                  'capacity' => $prison->capacity,
                  'status' => 'Operational',
              ];

              Log::info('Fetched prison', ['prison_id' => $prisonId]);
              return response()->json([$prisonData]);
          } catch (\Exception $e) {
              Log::error('Failed to fetch prison', ['error' => $e->getMessage()]);
              return response()->json(['error' => 'Failed to fetch prison'], 500);
          }
      }

      public function generateReport(Request $request)
      {
          try {
              $prisonId = session('prison_id');
              if (!$prisonId) {
                  Log::warning('No prison_id in session');
                  return response()->json(['error' => 'No prison assigned'], 403);
              }

              $reportType = $request->query('report_type', 'all_accounts');
              Log::info('Generating sysadmin report', ['report_type' => $reportType, 'prison_id' => $prisonId]);

              $data = [];
              switch ($reportType) {
                  case 'all_accounts':
                      $staff = Account::where('prison_id', $prisonId)
                          ->with('role')
                          ->get()
                          ->map(function ($account) {
                              return [
                                  'id' => $account->id,
                                  'name' => $account->first_name . ' ' . $account->last_name,
                                  'role' => $account->role ? $account->role->name : 'Staff',
                                  'prison' => $account->prison ? $account->prison->name : 'Unknown',
                                  'status' => 'Active'
                              ];
                          });
                      $prisoners = Prisoner::where('prison_id', $prisonId)
                          ->get()
                          ->map(function ($prisoner) {
                              return [
                                  'id' => $prisoner->id,
                                  'name' => $prisoner->name,
                                  'role' => 'Prisoner',
                                  'prison' => $prisoner->prison ? $prisoner->prison->name : 'Unknown',
                                  'status' => $prisoner->status ?? 'Incarcerated'
                              ];
                          });
                      $data = ['staff' => $staff, 'prisoners' => $prisoners];
                      break;
                  case 'staff':
                      $data = Account::where('prison_id', $prisonId)
                          ->with('role')
                          ->get()
                          ->map(function ($account) {
                              return [
                                  'id' => $account->id,
                                  'name' => $account->first_name . ' ' . $account->last_name,
                                  'role' => $account->role ? $account->role->name : 'Staff',
                                  'prison' => $account->prison ? $account->prison->name : 'Unknown',
                                  'status' => 'Active'
                              ];
                          });
                      break;
                  case 'prisoners':
                      $data = Prisoner::where('prison_id', $prisonId)
                          ->get()
                          ->map(function ($prisoner) {
                              return [
                                  'id' => $prisoner->id,
                                  'name' => $prisoner->name,
                                  'prison' => $prisoner->prison ? $prisoner->prison->name : 'Unknown',
                                  'sentence' => $prisoner->sentence ?? 'Unknown',
                                  'status' => $prisoner->status ?? 'Incarcerated'
                              ];
                          });
                      break;
                  case 'all_prisons':
                      $prison = Prison::findOrFail($prisonId);
                      $data = [[
                          'id' => $prison->id,
                          'name' => $prison->name,
                          'location' => $prison->location,
                          'capacity' => $prison->capacity,
                          'status' => 'Operational'
                      ]];
                      break;
                  default:
                      throw new \Exception('Invalid report type');
              }

              return response()->json($data);
          } catch (\Exception $e) {
              Log::error('Failed to generate sysadmin report', ['error' => $e->getMessage()]);
              return response()->json(['error' => 'Failed to generate report: ' . $e->getMessage()], 500);
          }
      }

      public function generate()
      {
          try {
              $prisonId = session('prison_id');
              if (!$prisonId) {
                  Log::warning('No prison_id in session');
                  return redirect()->back()->with('error', 'No prison assigned');
              }

              $prison = Prison::findOrFail($prisonId);
              Log::info('Fetched prison for generate page', ['prison_id' => $prisonId]);

              return view('sysadmin.generate_report', compact('prison'));
          } catch (\Exception $e) {
              Log::error('Failed to fetch prison for generate page', ['error' => $e->getMessage()]);
              return redirect()->back()->with('error', 'Failed to load prison details');
          }
      }

      public function initiateBackup(Request $request)
      {
          try {
              $userId = session('user_id');
              $prisonId = session('prison_id');
              Log::info('Backup process initiated by user.', [
                  'user_id' => $userId,
                  'prison_id' => $prisonId,
              ]);

              $backup = Backup::create([
                  'initiated_by' => $userId,
                  'prison_id' => $prisonId,
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
          } catch (\Exception $e) {
              if (isset($backup)) {
                  $backup->update(['backup_status' => 'failed']);
              }
              Log::error('Backup process failed.', [
                  'message' => $e->getMessage(),
                  'user_id' => session('user_id'),
                  'prison_id' => session('prison_id'),
              ]);
              return response()->json(['error' => 'Backup failed: ' . $e->getMessage()], 500);
          }
      }


      public function storeReport(Request $request)
      {
          try {
              $request->validate([
                  'report_type' => 'required|in:all_accounts,staff,prisoners,all_prisons',
                  'content' => 'required|json',
              ]);

              $generatedBy = session('user_id');
              $reportType = $request->report_type;
              $content = $request->content;
              $prisonId = session('prison_id');

              $recentReport = Report::where('generated_by', $generatedBy)
                  ->where('report_type', $reportType)
                  ->where('content', $content)
                  ->where('created_at', '>=', now()->subSeconds(5))
                  ->first();

              if ($recentReport) {
                  Log::warning('Duplicate report detected, skipping storage', [
                      'generated_by' => $generatedBy,
                      'report_type' => $reportType,
                  ]);
                  return response()->json(['success' => true, 'id' => $recentReport->id], 200);
              }

              $report = Report::create([
                  'generated_by' => $generatedBy,
                  'report_type' => $reportType,
                  'content' => $content,
                  'prison_id' => $prisonId,
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
              $prisonId = session('prison_id');
              if (!$prisonId) {
                  Log::warning('No prison_id in session');
                  return view('sysadmin.view_reports', ['reports' => [], 'prison' => null])
                      ->with('error', 'No prison assigned to this session.');
              }
  
              $prison = Prison::findOrFail($prisonId);
              $reports = Report::with('user')
                  ->where('prison_id', $prisonId)
                  ->get()
                  ->map(function ($report) {
                      $content = json_decode($report->content, true) ?? [];
                      return [
                          'id' => $report->id,
                          'generated_by' => $report->user
                              ? $report->user->first_name . ' ' . $report->user->last_name
                              : ($report->generated_by ?? 'Unknown'),
                          'report_type' => ucfirst($report->report_type ?? 'Unknown'),
                          'created_at' => $report->created_at->format('M d, Y H:i:s'),
                          'content' => $content,
                          'content_raw' => $report->content
                      ];
                  });
  
              Log::info('Fetched reports for view', ['prison_id' => $prisonId, 'count' => $reports->count()]);
  
              return view('sysadmin.view_reports', compact('reports', 'prison'));
          } catch (\JsonException $e) {
              Log::error('JSON decoding failed in viewReports', ['error' => $e->getMessage()]);
              return view('sysadmin.view_reports', ['reports' => [], 'prison' => null])
                  ->with('error', 'Failed to process report data.');
          } catch (\Exception $e) {
              Log::error('Failed to fetch reports', ['error' => $e->getMessage()]);
              return view('sysadmin.view_reports', ['reports' => [], 'prison' => null])
                  ->with('error', 'Failed to load reports.');
          }
      }
  
      public function viewBackupLogs()
    {
        try {
            $prisonId = session('prison_id');
            if (!$prisonId) {
                Log::warning('No prison_id in session');
                return view('sysadmin.view_backup_logs', ['backups' => [], 'prison' => null])
                    ->with('error', 'No prison assigned to this session.');
            }

            $prison = Prison::findOrFail($prisonId);
            $backups = Backup::leftJoin('accounts', 'backups.initiated_by', '=', 'accounts.user_id')
                ->leftJoin('prisons', 'backups.prison_id', '=', 'prisons.id')
                ->where('backups.prison_id', $prisonId)
                ->select(
                    'backups.id',
                    DB::raw("COALESCE(CONCAT(accounts.first_name, ' ', accounts.last_name), 'Unknown') as initiated_by"),
                    'prisons.name as prison_name',
                    'backups.backup_date',
                    'backups.backup_status'
                )
                ->orderBy('backups.backup_date', 'desc')
                ->get()
                ->map(function ($backup) {
                    return [
                        'id' => $backup->id,
                        'initiated_by' => $backup->initiated_by,
                        'prison_name' => $backup->prison_name,
                        'backup_date' => Carbon::parse($backup->backup_date)->format('M d, Y H:i:s'),
                        'backup_status' => ucfirst($backup->backup_status ?? 'Unknown')
                    ];
                });

            Log::info('Fetched backup logs for view', ['prison_id' => $prisonId, 'count' => $backups->count()]);

            return view('sysadmin.view_backup_logs', compact('backups', 'prison'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch backup logs', ['error' => $e->getMessage()]);
            return view('sysadmin.view_backup_logs', ['backups' => [], 'prison' => null])
                ->with('error', 'Failed to load backup logs.');
        }
    }
    public function updateacc(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts,email,' . $user_id . ',user_id',
            'phone_number' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|in:Male,Female,Other',
            'address' => 'nullable|string',
            'role_id' => 'required|exists:roles,id',
            'prison_id' => 'nullable|exists:prisons,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $account = Account::findOrFail($user_id);
        $account->update($request->only([
            'first_name', 'last_name', 'email', 'phone_number',
            'dob', 'gender', 'address', 'role_id', 'prison_id'
        ]));

        return response()->json(['message' => 'Account updated successfully']);
    }

    public function destroyacc($user_id)
    {
        $account = Account::findOrFail($user_id);
        $account->delete();

        return response()->json(['message' => 'Account deleted successfully']);
    }
  }