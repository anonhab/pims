<?php
namespace App\Http\Controllers\sysadmin;

use App\Http\Controllers\Controller;

use App\Models\Account;
use App\Models\Prison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class sAccountController extends Controller
{
    // Show all accounts
 public function show_all()
    {
        $accounts=Account::all();
        return view('sysadmin.view_account',compact('accounts'));
    }

    public function account_add()

    {
        $account = Account::all(); 
        $prisons = Prison::all();
        return view('sysadmin.create_account',compact('account','prisons'));
    }
 
 

public function store(Request $request)
{
    Log::info('User registration attempt', ['username' => $request->username]);

    $imagePath = null;
    if ($request->hasFile('user_image')) {
        $imagePath = $request->file('user_image')->store('user_images', 'public'); // Saves in storage/app/public/user_images
        Log::info('user image uploaded successfully.', ['image_path' => $imagePath]);
    } else {
        Log::warning('No user image uploaded.');
    }
    

    try {
        // Create user record
        $user = Account::create([
            'username' => $request->username,
            'password' => bcrypt($request->password), // Encrypt password
            'role' => $request->role,
            'prison_id' => $request->prison_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
            'user_image' => $imagePath, // Store image path
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
