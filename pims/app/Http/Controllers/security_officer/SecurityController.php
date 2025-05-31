<?php

namespace App\Http\Controllers\Security_Officer;

use App\Http\Controllers\Controller;
use App\Models\LawyerAppointment;
use App\Models\MedicalAppointment;
use App\Models\NewVisitingRequest;
use App\Models\Notification;
use App\Models\Prisoner;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SecurityController extends Controller
{
    public function showVisitor($id)
{
    $visitor = Visitor::with(['visits'])->findOrFail($id);

    return response()->json($visitor);
}
    // Dashboard view with visitor metrics
    public function dashboard()
{
    $prisonId = session('prison_id'); // Get current prison ID from session

    // Visitor metrics scoped to prison
    $visitorsToday = NewVisitingRequest::whereDate('requested_date', today())
        ->where('prison_id', $prisonId)
        ->count();

    $pendingApprovals = NewVisitingRequest::where('status', 'pending')
        ->where('prison_id', $prisonId)
        ->count();

    $securityAlerts = Notification::where('recipient_role', 'security_officer')
        ->where('is_read', false)
        ->where('prison_id', $prisonId)
        ->count();

    // Load only visitors related to the current prison
    $prisonId = session('prison_id');

    $visitors = Visitor::whereHas('visits', function ($query) use ($prisonId) {
        $query->where('prison_id', $prisonId);
    })
    ->with(['visits' => function ($query) use ($prisonId) {
        $query->where('prison_id', $prisonId);
    }])
    ->take(10)
    ->get();
    
    $totalVisitors = Visitor::count();

    // Appointment metrics scoped to prison
    $pendingMedicalAppointments = MedicalAppointment::where('status', 'scheduled')
        ->where('prison_id', $prisonId)
        ->count();

    $pendingLawyerAppointments = LawyerAppointment::where('status', 'scheduled')
        ->where('prison_id', $prisonId)
        ->count();

    $pendingVisitorAppointments = NewVisitingRequest::where('status', 'pending')
        ->where('prison_id', $prisonId)
        ->count();

        $weekStart = today()->startOfWeek();

        $monData = NewVisitingRequest::whereDate('requested_date', $weekStart)
            ->where('prison_id', $prisonId)
            ->where('status', 'approved')
            ->count();
        
        $tueData = NewVisitingRequest::whereDate('requested_date', $weekStart->copy()->addDay())
            ->where('prison_id', $prisonId)
            ->where('status', 'approved')
            ->count();
        
        $wedData = NewVisitingRequest::whereDate('requested_date', $weekStart->copy()->addDays(2))
            ->where('prison_id', $prisonId)
            ->where('status', 'approved')
            ->count();
        
        $thuData = NewVisitingRequest::whereDate('requested_date', $weekStart->copy()->addDays(3))
            ->where('prison_id', $prisonId)
            ->where('status', 'approved')
            ->count();
        
        $friData = NewVisitingRequest::whereDate('requested_date', $weekStart->copy()->addDays(4))
            ->where('prison_id', $prisonId)
            ->where('status', 'approved')
            ->count();
        
        $satData = NewVisitingRequest::whereDate('requested_date', $weekStart->copy()->addDays(5))
            ->where('prison_id', $prisonId)
            ->where('status', 'approved')
            ->count();
        
        $sunData = NewVisitingRequest::whereDate('requested_date', $weekStart->copy()->addDays(6))
            ->where('prison_id', $prisonId)
            ->where('status', 'approved')
            ->count();
        
    return view('security_officer.dashboard', compact(
        'visitorsToday',
        'pendingApprovals',
        'securityAlerts',
        'visitors',
        'totalVisitors',
        'pendingMedicalAppointments',
        'pendingLawyerAppointments',
        'pendingVisitorAppointments',
        'monData',
        'tueData',
        'wedData',
        'thuData',
        'friData',
        'satData',
        'sunData'
    ));
}
    public function changePassword(Request $request, $visitor_id)
{
   

    $visitor = Visitor::findOrFail($visitor_id);
    $visitor->password = Hash::make($request->new_password);
    $visitor->save();

    return response()->json(['message' => 'Password updated successfully'], 200);
}
    private function createNotification($recipientId, $recipientRole, $roleId, $relatedTable, $relatedId, $title, $message, $prisonId)
    {
        Notification::create([
            'recipient_id' => $recipientId,
            'recipient_role' => $recipientRole,
            'role_id' => $roleId,
            'related_table' => $relatedTable,
            'related_id' => $relatedId,
            'title' => $title,
            'message' => $message,
            'is_read' => false,
            'prison_id' => $prisonId,
        ]);
    }
    

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
    Log::info('Update status request received', [
        'input' => $request->all(),
        'user_id' => session('user_id'),
    ]);

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

        Log::info('Fetching appointment', ['appointment_id' => $appointmentId, 'type' => $type]);
        $appointment = $this->getAppointmentModel($type, $appointmentId);

        if (!$appointment) {
            Log::warning('Appointment not found', ['appointment_id' => $appointmentId, 'type' => $type]);
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found'
            ], 404);
        }

        Log::info('Updating appointment status', [
            'appointment_id' => $appointmentId,
            'old_status' => $appointment->status,
            'new_status' => $status,
            'notes' => $notes
        ]);
        $appointment->status = $status;
        $appointment->note = $notes;
        $appointment->save();
        Log::info('Appointment updated successfully', ['appointment_id' => $appointmentId]);

        $visitor = Visitor::find($appointment->visitor_id);
        $prisoner = Prisoner::find($appointment->prisoner_id);
        $prisonId = session('prison_id');

        // Send notification even if visitor or prisoner might be null
        $this->createNotification(
            $visitor ? $visitor->id : null,
            'visitor',
            null,  // adjust role_id as needed
            'new_visiting_requests',
            $appointment->id,
            "Visiting Request {$status}",
            "Your visiting request for prisoner " 
                . ($prisoner ? "{$prisoner->first_name} {$prisoner->last_name}" : "Unknown Prisoner") 
                . " has been {$status}" 
                . ($notes ? ". Notes: {$notes}" : ""),
            $prisonId
        );

        Log::info('Notification sent (or attempted)', [
            'visitor_id' => $visitor ? $visitor->id : 'null',
            'prison_id' => $prisonId,
            'appointment_id' => $appointment->id,
            'status' => $status,
        ]);

        Log::info('Appointment status update completed', [
            'appointment_id' => $appointmentId,
            'type' => $type,
            'status' => $status,
            'updated_by' => session('user_id')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment status updated successfully',
            'appointment' => $appointment
        ]);

    } catch (\Exception $e) {
        Log::error('Appointment status update failed', [
            'error' => $e->getMessage(),
            'appointment_id' => $request->input('appointment_id')
        ]);

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
       
    try {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Visitor deleted successfully.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to delete visitor.',
            'error' => $e->getMessage()
        ], 500);
    }
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
