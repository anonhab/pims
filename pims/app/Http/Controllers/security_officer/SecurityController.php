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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        $visitorAppointments = NewVisitingRequest::where('prison_id', session('prison_id'))->get();
    
        // Pass data to the view
        return view('security_officer.prisoner_status', compact('medicalAppointments', 'lawyerAppointments', 'visitorAppointments'));
    }


public function verify(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
    ]);

    try {
        $firstName = $request->input('first_name');
        $middleName = $request->input('middle_name');
        $lastName = $request->input('last_name');

        // Search for prisoner with matching names and prison_id from session
        $query = Prisoner::where('first_name', 'like', "%{$firstName}%")
                        ->where('last_name', 'like', "%{$lastName}%")
                        ->where('prison_id', session('prison_id'));

        if ($middleName) {
            $query->where('middle_name', 'like', "%{$middleName}%");
        }

        $prisoner = $query->first();

        if ($prisoner) {
            return response()->json([
                'success' => true,
                'message' => 'Prisoner verified successfully',
                'prisoner_id' => $prisoner->id,
                'prisoner' => [
                    'full_name' => $prisoner->first_name . ' ' . 
                                  ($prisoner->middle_name ? $prisoner->middle_name . ' ' : '') . 
                                  $prisoner->last_name,
                    'id_number' => $prisoner->id
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No prisoner found with matching details'
        ], 404);

    } catch (\Exception $e) {
        Log::error('Prisoner verification failed: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred during verification'
        ], 500);
    }
}

public function updateStatus(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required',
            'appointment_type' => 'required|in:medical,lawyer,visitor',
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string|max:500'
        ]);

        try {
            $appointmentId = $request->input('appointment_id');
            $type = $request->input('appointment_type');
            $status = $request->input('status');
            $notes = $request->input('notes');

            $appointment = $this->getAppointmentModel($type, $appointmentId);

            if (!$appointment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Appointment not found'
                ], 404);
            }

            // Update status
            $appointment->status = $status;
            $appointment->note = $notes;
           
            $appointment->save();

            

            return response()->json([
                'success' => true,
                'message' => 'Appointment status updated successfully',
                'appointment' => $appointment
            ]);

        } catch (\Exception $e) {
            Log::error('Appointment status update failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update appointment status'
            ], 500);
        }
    }

    protected function getAppointmentModel($type, $id)
    {
        switch ($type) {
            case 'medical':
                return MedicalAppointment::find($id);
            case 'lawyer':
                return LawyerAppointment::find($id);
            case 'visitor':
                return NewVisitingRequest::find($id);
            default:
                return null;
        }
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
    public function updatevisitor(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'relationship' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'identification_number' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $visitor = Visitor::findOrFail($id);
        $visitor->update($request->only([
            'first_name', 'last_name', 'phone_number', 'relationship',
            'address', 'identification_number'
        ]));

        return response()->json(['message' => 'Visitor updated successfully']);
    }

    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);
        if ($visitor->visits()->exists()) {
            return response()->json(['message' => 'Cannot delete visitor with associated visits'], 422);
        }
        $visitor->delete();
        return response()->json(['message' => 'Visitor deleted successfully']);
    }
}
