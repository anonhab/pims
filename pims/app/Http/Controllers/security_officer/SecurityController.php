<?php

namespace App\Http\Controllers\Security_Officer;

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

    // Show edit form
    public function editVisitor($id)
    {
        $visitor = Visitor::findOrFail($id);
        return view('security_officer.editVisitor', compact('visitor'));
    }

    // Update visitor data
    public function updateVisitor(Request $request, $id)
    {
        $visitor = Visitor::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone_number' => 'required|string|max:20',
            'relationship' => 'required|string|max:50',
            'address' => 'required|string',
            'identification_number' => 'required|string|max:100|unique:visitors,identification_number,' . $id,
            'username' => 'required|string|max:255|unique:visitors,username,' . $id . ',id',
        ]);

        $visitor->update($validatedData);

        return redirect()->route('security_officer.viewvisitors')->with('success', 'Visitor updated successfully.');
    }

    // Delete visitor
    public function deleteVisitor($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();

        return redirect()->route('security_officer.viewvisitors')->with('success', 'Visitor deleted successfully.');
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
        return redirect()->route('security_officer.viewAppointments')->with('success', 'Visiting time request created successfully');
    }

    // View list of appointments
    public function viewAppointments()
    {
        return view('security_officer.viewAppointments');
    }

    // View list of prisoners (if needed)
    public function viewPrisoners()
    {
        return view('security_officer.viewPrisoners', compact('prisoners'));
    }
}
