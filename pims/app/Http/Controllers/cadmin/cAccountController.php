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
        $startDate = Carbon::now()->subDays(7); // Get last 7 days data

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

    public  function dashboard()
    {

        return view('cadmin.dashboard');
    }

    public  function generate()
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
        // $admins = Account::findOrFail('')
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
        $accounts = Account::with('role')->paginate(10); // Fetch accounts with roles and paginate
        return view('cadmin.view_accounts', compact('accounts','roles'));
    }

    public function prisonstore(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        // Store the new prison
        Prison::create($validated);

        // Redirect with a success message
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

    // Check if the username already exists
    if (Account::where('username', $request->username)->exists()) {
        Session::flash('error', 'Username already exists. Please choose a different one.');
        return redirect()->back();
    }

    // Initialize image path
    $imagePath = null;

    // Handle image upload safely
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
        // Use a transaction to ensure data integrity
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
                'user_image' => $imagePath, // Store the image path
            ]);

            Log::info('User created successfully', ['id' => $user->user_id, 'username' => $user->username]);
        });

        Session::flash('success', 'User registered successfully!');
        return redirect()->back();
    } catch (\Illuminate\Database\QueryException $e) {
        if ($e->getCode() == 23000) { // Duplicate entry error
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
}
