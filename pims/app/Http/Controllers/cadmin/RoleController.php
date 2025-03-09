<?php


namespace App\Http\Controllers\cadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('cadmin.view_roles', compact('roles'));
 
    }
    
     public function addrole()
    {
        $roles = Role::all();
        return view('cadmin.add_roles', compact('roles'));
 
    }
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|unique:roles,name|max:50',
            'description' => 'required|max:255',
        ]);

        // Create the role
        Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        
        return redirect()->back()->with('success', 'Role created successfully');
    }
}