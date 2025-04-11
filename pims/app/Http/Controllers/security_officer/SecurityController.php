<?php

namespace App\Http\Controllers\Security_Officer;

use App\Http\Controllers\Controller;
use App\Models\LawyerAppointment;
use App\Models\MedicalAppointment;
use App\Models\NewVisitingRequest;
use App\Models\Prisoner;
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
    // In VisitorController.php or any relevant controller
public function validatePrisoner(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string',
        'middle_name' => 'nullable|string',
        'last_name' => 'required|string',
    ]);

    // Check if the prisoner exists in the database
    $prisoner = Prisoner::where('first_name', $validated['first_name'])
                        ->where('middle_name', $validated['middle_name'])
                        ->where('last_name', $validated['last_name'])
                        ->first();

    if ($prisoner) {
        return response()->json(['status' => 'success', 'message' => 'Prisoner data matches!']);
    } else {
        return response()->json(['status' => 'error', 'message' => 'Prisoner data does not match.']);
    }
}

  // Assuming Appointment is your model for storing appointments

    public function viewprisonerstatus()
    {
        // Fetch appointments data (you can add more logic here to filter or paginate)
        $medicalAppointments = MedicalAppointment::all();
        $lawyerAppointments = LawyerAppointment::all();
        $visitorAppointments = NewVisitingRequest::all();
    
        // Pass data to the view
        return view('security_officer.prisoner_status', compact('medicalAppointments', 'lawyerAppointments', 'visitorAppointments'));
    }
    
 
    public function updateStatus(Request $request)
    {
        // Validate the request
       

        // Find the appointment by its ID
        $appointment = NewVisitingRequest::findOrFail($request->appointment_id);

        // Update the status
        $appointment->status = $request->status;

        // Optionally update the updated_at timestamp
        $appointment->updated_at = now();

        // Save the changes to the database
        $appointment->save();

        // You can return a response or redirect after the update
        return redirect()->back()->with('success', 'Appointment status updated successfully');
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
        'email' => 'required|email|max:255|unique:visitors,email',
        'password' => 'required|string|min:6',
    ]);

    $visitor = new Visitor();
    $visitor->first_name = $validatedData['first_name'];
    $visitor->last_name = $validatedData['last_name'];
    $visitor->phone_number = $validatedData['phone_number'];
    $visitor->relationship = $validatedData['relationship'];
    $visitor->address = $validatedData['address'];
    $visitor->identification_number = $validatedData['identification_number'];
    $visitor->email = $validatedData['email'];
    $visitor->password = Hash::make($validatedData['password']);

    $visitor->save();

    return redirect()->route('security_officer.viewvisitors')
                     ->with('success', 'Visitor registered successfully');
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
