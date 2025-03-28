<?php
namespace App\Http\Controllers\sysadmin;

use App\Http\Controllers\Controller;

use App\Models\Account;
use App\Models\Prison;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class sAccountController extends Controller
{
    // Show all accounts
    public function show_all()
    {
        $roles = Role::all();
        // Fetch accounts excluding role_id = 1 and role_id = 3
        $accounts = Account::whereNotIn('role_id', [1, 3])
            ->where('prison_id', session('prison_id'))
            ->paginate(3);
    
        // Pass the filtered accounts to the view
        return view('sysadmin.view_account', compact('accounts','roles'));
    }
    
    public function account_add()

    {
        $account = Account::all(); 
        $prisons = Prison::all();
        $roles = Role::whereNotIn('id', [1, 3])->get();

        return view('sysadmin.create_account', compact('account', 'prisons', 'roles'));

         
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
