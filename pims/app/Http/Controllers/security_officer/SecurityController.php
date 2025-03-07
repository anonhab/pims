<?php

namespace App\Http\Controllers\security_officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
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

    // Show form to register a visitor
    public function registerVisitor()
    {
        return view('security_officer.registerVisitor');
    }

    // Store the registered visitor information
    public function storeVisitor(Request $request)
    {
        // Logic to save visitor information
        // Example: Visitor::create($request->all());

        return redirect()->route('security_officer.viewVisitors')->with('success', 'Visitor registered successfully');
    }

    // View list of appointments
    public function viewAppointments()
    {
        // Fetch the appointments from the database
        // Example: $appointments = Appointment::all();
        
        return view('security_officer.viewAppointments', compact('appointments'));
    }

    // View list of prisoners (if needed)
    public function viewPrisoners()
    {
        // Fetch the prisoners from the database
        // Example: $prisoners = Prisoner::all();

        return view('security_officer.viewPrisoners', compact('prisoners'));
    }

    // View list of visitors (if needed)
    public function viewVisitors()
    {
        // Fetch the registered visitors from the database
        // Example: $visitors = Visitor::all();

        return view('security_officer.viewVisitors', compact('visitors'));
    }
}
