<?php

namespace App\Http\Controllers\security_officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SecurityController extends Controller
{
    // Show form to register a visitor
    public function registerVisitor()
    {
        return view('security_officer.registerVisitor');
    }

    // Store the registered visitor information
    public function storeVisitor(Request $request)
{
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'phone_number' => 'required|string|max:20',
        'relationship' => 'required|string|max:50',
        'address' => 'required|string',
        'identification_number' => 'required|string|max:100|unique:visitors,identification_number',
        'username' => 'required|string|max:255|unique:visitors,username',
        'password' => 'required|string|min:6',
    ]);

    // Create visitor instance
    $visitor = new Visitor();
    // Remove this line: $visitor->id = Str::uuid(); (since MySQL auto-generates an ID)
    $visitor->first_name = $validatedData['first_name'];
    $visitor->last_name = $validatedData['last_name'];
    $visitor->phone_number = $validatedData['phone_number'];
    $visitor->relationship = $validatedData['relationship'];
    $visitor->address = $validatedData['address'];
    $visitor->identification_number = $validatedData['identification_number'];
    $visitor->username = $validatedData['username'];
    $visitor->password = Hash::make($validatedData['password']); // Hash password

    $visitor->save();

    return redirect()->route('security_officer.viewvisitors')->with('success', 'Visitor registered successfully');
}


    // View list of visitors
    public function viewVisitors()
    {
        $visitors = Visitor::all();
        return view('security_officer.viewvisitors', compact('visitors'));
    }

    // Show form to create a visiting time request
    public function createVisitingTime()
    {
        return view('security_officer.createVisitingTime');
    }

    // Store the visiting time request
    public function storeVisitingTime(Request $request)
    {
        // Logic to save the visiting time request
        // Example: VisitingTime::create($request->all());

        return redirect()->route('security_officer.viewAppointments')->with('success', 'Visiting time request created successfully');
    }

    // View list of appointments
    public function viewAppointments()
    {
        // Fetch the appointments from the database
        // Example: $appointments = Appointment::all();
        
        return view('security_officer.viewAppointments');
    }

    // View list of prisoners (if needed)
    public function viewPrisoners()
    {
        // Fetch the prisoners from the database
        // Example: $prisoners = Prisoner::all();

        return view('security_officer.viewPrisoners', compact('prisoners'));
    }
}