<?php


namespace App\Http\Controllers\cadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Prison;
use App\Models\Prisoner;
use App\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class cAccountController extends Controller
{
    // Show all accounts

 public function prisonadd()
    {
       return view('cadmin.add_prison');
    }
    public function prisonview()
    {
        $prisons=Prison::all();
        return view('cadmin.view_prison',compact('prisons'));
    }
 public function show_all()
    {
        $accounts = Account::with('role')->get(); 
        return view('cadmin.view_accounts',compact('accounts'));
    }
    public function prisonstore(Request $request){
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
        $prisoners=Prisoner::all(); 
        return view('cadmin.view_prisoners',compact('prisoners'));
    }
     public function all()
    {
        $accounts=Account::all();
        return view('cadmin.view_account',compact('accounts'));
    }
    public function add_prison(){
        return view('cadmin.add_prison');
    }
    public function view_prison(){
        return view('cadmin.view_prison');
    }

    public function account_add()

    {
        $account = Account::all(); 
        $prisons = Prison::all();
        $roles= Role::all();
        return view('cadmin.create_account',compact('account','prisons', 'roles'));
    }
 
 
    public function store(Request $request)
    {
        Log::info('User registration attempt', ['username' => $request->username]);
    
        // Check if the email already exists
        $existingUser = Account::where('email', $request->email)->first();
        if ($existingUser) {
            Log::error('Email already exists', ['email' => $request->email]);
            session()->flash('error', 'The email address is already registered.');
            return redirect()->back()->with('error', 'The email address is already registered.');
        }
    
        // Initialize image path
        $imagePath = null;
    
        // Check if user has uploaded an image
        if ($request->hasFile('user_image')) {
            try {
                // Store the image in public storage and get the path
                $imagePath = $request->file('user_image')->store('user_images', 'public');
                Log::info('User image uploaded successfully.', ['image_path' => $imagePath]);
            } catch (\Exception $e) {
                Log::error('Image upload failed', ['error' => $e->getMessage()]);
                session()->flash('error', 'Image upload failed.');
                return redirect()->back()->with('error', 'Image upload failed.');
            }
        } else {
            Log::warning('No user image uploaded.');
        }
    
        try {
            // Create the user record
            $user = Account::create([
                'username' => $request->username,
                'password' => bcrypt($request->password), // Encrypt password
                'role_id' => $request->role_id, // Assuming role_id is the correct field in the database
                'prison_id' => $request->prison_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'address' => $request->address,
                'user_image' => $imagePath, // Store the image path
            ]);
    
            Log::info('User created successfully', ['id' => $user->user_id, 'username' => $user->username]);
    
            // Flash success message and redirect back
            session()->flash('success', 'User registered successfully!');
            return redirect()->back()->with('success', 'User registered successfully!');
        } catch (\Exception $e) {
            // Log any errors and flash error message
            Log::error('User registration failed', ['error' => $e->getMessage()]);
            session()->flash('error', 'Failed to register user.');
    
            return redirect()->back()->with('error', 'Failed to register user.');
        }
    }
    
    
    
public function destroy($user_id)
{
    $account = Account::find($user_id);

    if ($account) {
        // Log the account deletion attempt
        Log::info('Attempting to delete account', [
            'user_id' => $user_id,
            'username' => $account->username,
        ]);

        $account->delete();

        // Log successful deletion
        Log::info('Account deleted successfully', [
            'user_id' => $user_id,
            'username' => $account->username,
        ]);

        return response()->json(['success' => true]);
    }

   

    return response()->json(['success' => false]);
}



}
