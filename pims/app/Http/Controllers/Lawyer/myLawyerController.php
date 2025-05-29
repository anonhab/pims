<?php

namespace App\Http\Controllers\lawyer;

use App\Http\Controllers\Controller;
use App\Models\LawyerAppointment;
use App\Models\Requests;
use App\Models\Prisoner;
use App\Models\Account;
use App\Models\Notification;
use App\Models\LawyerPrisonerAssignment;
use App\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class myLawyerController extends Controller
{
    // Helper method to create prisoner-related notifications
    private function createNotification($recipientId, $recipientRole, $roleId, $relatedTable, $relatedId, $title, $message, $prisonId)
{
    Notification::create([
        'recipient_id' => $recipientId,
        'recipient_role' => $recipientRole,
        'role_id' => $roleId, // added role ID
        'related_table' => $relatedTable,
        'related_id' => $relatedId,
        'title' => $title,
        'message' => $message,
        'is_read' => false,
        'prison_id' => $prisonId, // added prison ID
    ]);
}


public function ldashboard()
{
    $lawyerId = session('lawyer_id');
    $prisonId = session('prison_id');
    $userId = session('user_id');

    if (!$lawyerId || !$prisonId) {
        Log::warning('Missing session data for lawyer dashboard', [
            'lawyer_id' => $lawyerId,
            'prison_id' => $prisonId,
            'user_id' => $userId
        ]);
        return redirect()->route('login')->with('error', 'Unauthorized access. Please log in.');
    }

   
        // Dashboard Cards
        $activeClients = LawyerPrisonerAssignment::where('lawyer_id', $lawyerId)
            ->where('prison_id', $prisonId)
            ->count();

        $pendingRequests = Requests::where('lawyer_id', $lawyerId)
            ->where('prison_id', $prisonId)
            ->where('status', 'pending')
            ->count();

        $approvedRequests = Requests::where('lawyer_id', $lawyerId)
            ->where('prison_id', $prisonId)
            ->where('status', 'approved')
            ->count();

        $rejectedRequests = Requests::where('lawyer_id', $lawyerId)
            ->where('prison_id', $prisonId)
            ->where('status', 'rejected')
            ->count();

        // Recent Appointments (Today's)
        $recentAppointments = LawyerAppointment::where('lawyer_id', $lawyerId)
            ->where('prison_id', $prisonId)
            ->whereDate('appointment_date', now()->startOfDay())
            ->with(['prisoner', 'lawyer'])
            ->orderBy('appointment_date')
            ->take(5)
            ->get();

        // Request Status Distribution Chart (Pie)
        $requestStatuses = Requests::where('lawyer_id', $lawyerId)
            ->where('prison_id', $prisonId)
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $requestStatusChartData = [
            'pending' => $requestStatuses['pending'] ?? 0,
            'approved' => $requestStatuses['approved'] ?? 0,
            'rejected' => $requestStatuses['rejected'] ?? 0,
        ];

        // Case Activity Trends Chart (Line)
        $days = collect(range(6, 0))->map(function ($i) {
            return now()->subDays($i)->format('D');
        })->toArray();

        $caseTrendsData = collect(range(6, 0))->map(function ($i) use ($lawyerId, $prisonId) {
            $date = now()->subDays($i)->startOfDay();
            return Requests::where('lawyer_id', $lawyerId)
                ->where('prison_id', $prisonId)
                ->whereDate('created_at', $date)
                ->count();
        })->toArray();

        $caseTrendsChartData = [
            'labels' => $days,
            'requests' => $caseTrendsData,
        ];

        Log::info('Lawyer dashboard data fetched', [
            'lawyer_id' => $lawyerId,
            'prison_id' => $prisonId,
            'active_clients' => $activeClients,
            'pending_requests' => $pendingRequests,
            'approved_requests' => $approvedRequests,
            'rejected_requests' => $rejectedRequests,
            'recent_appointments_count' => $recentAppointments->count(),
            'request_status_chart_data' => $requestStatusChartData,
            'case_trends_chart_data' => $caseTrendsChartData,
        ]);

        return view('lawyer.dashboard', compact(
            'activeClients',
            'pendingRequests',
            'approvedRequests',
            'rejectedRequests',
            'recentAppointments',
            'requestStatusChartData',
            'caseTrendsChartData'
        ));
    
        Log::error('Error fetching lawyer dashboard data', [
            'error' => $e->getMessage(),
            'lawyer_id' => $lawyerId,
            'prison_id' => $prisonId
        ]);
        return redirect()->route('login')->with('error', 'Failed to load dashboard.');
    
}
    public function rstore(Request $request)
    {
        // Validate request data
        $request->validate([
            'request_type' => 'required|string',
            'status' => 'required|string|in:pending,approved,rejected',
            'request_details' => 'required|string',
            'prisoner_id' => 'required|exists:prisoners,id',
        ]);
    
        // Check session values
        $lawyerId = session('lawyer_id');
        $userId = session('user_id');
        $prisonId = session('prison_id');
    
        Log::info('Session Data:', ['lawyer_id' => $lawyerId, 'user_id' => $userId, 'prison_id' => $prisonId]);
    
        if (is_null($prisonId)) {
            Log::error('prison_id is NULL before creating request.');
            return redirect()->back()->with('error', 'Prison ID not found in session.');
        }
    
        // Create the request record
        $requestData = [
            'lawyer_id' => $lawyerId ?: null,
            'user_id' => $userId ?: null,
            'request_type' => $request->request_type,
            'status' => $request->status,
            'approved_by' => $request->approved_by ?: null,
            'request_details' => $request->request_details,
            'prisoner_id' => $request->prisoner_id,
            'prison_id' => $prisonId,
        ];
    
        $requestRecord = Requests::create($requestData);
    
        // Get prisoner details
        $prisoner = Prisoner::find($request->prisoner_id);
    
        // Notify discipline officer
        $this->createNotification(
            $lawyerId,
            'lawyer',
            '11', // You may want to dynamically determine recipient ID and type
            'requests',
            $requestRecord->id,
            'Request Submitted',
            "A {$request->request_type} request has been submitted for prisoner {$prisoner->first_name} {$prisoner->last_name}.",
            $prisonId
        );
    
        // ✅ Return back with a success message
        return redirect()->back()->with('success', 'Request submitted successfully.');
    }
    

    public function prstore(Request $request)
    {
        $request->validate([
            'request_type' => 'required|string',
            'status' => 'required|string|in:pending,approved,rejected',
            'request_details' => 'required|string',
            'prisoner_id' => 'required|exists:prisoners,id',
        ]);

        $officerId = session('user_id');
        $prisonId = session('prison_id');

        Log::info('Session Data:', ['officer_id' => $officerId, 'prison_id' => $prisonId]);

        if (is_null($prisonId)) {
            Log::error('prison_id is NULL before creating police request.');
            return redirect()->back()->with('error', 'Prison ID not found in session.');
        }

        $requestData = [
            'user_id' => $officerId ?: null,
            'request_type' => $request->request_type,
            'status' => $request->status,
            'approved_by' => $request->approved_by ?: null,
            'request_details' => $request->request_details,
            'prisoner_id' => $request->prisoner_id,
            'prison_id' => $prisonId,
        ];

        $requestRecord = Requests::create($requestData);

        $prisoner = Prisoner::find($request->prisoner_id);
        
        $this->createNotification(
            null,
            'officer',
            '11',
            'requests',
            $requestRecord->id,
            'Request Submitted',
            "a {$request->request_type} request for prisoner {$prisoner->first_name} {$prisoner->last_name}.",
            $prisonId
        );

       
        Log::info('Police request successfully inserted with ID: ' . $requestRecord->id, $requestData);

        return redirect()->back()->with('success', 'Request submitted successfully.');
    }

    public function astore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prisoner_id' => 'required|exists:prisoners,id',
            'lawyer_id' => 'required|exists:lawyers,lawyer_id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $appointment = LawyerAppointment::create([
            'prisoner_id' => $request->prisoner_id,
            'lawyer_id' => $request->lawyer_id,
            'appointment_date' => $request->appointment_date,
            'status' => 'scheduled',
            'notes' => $request->notes,
        ]);

        $prisonId = session('prison_id');

        $prisoner = Prisoner::find($request->prisoner_id);
        $lawyer = Lawyer::find($request->lawyer_id);

      

        $this->createNotification(
            $request->lawyer_id,
            'lawyer',
            '11',
            'lawyer_appointments',
            $appointment->id,
            'New Appointment Assigned',
            "a request for legal appointment with prisoner {$prisoner->first_name} {$prisoner->last_name} on {$request->appointment_date}.",
            $prisonId
        );

     
        Log::info('Legal appointment created successfully', [
            'appointment_id' => $appointment->id,
            'prisoner_id' => $request->prisoner_id,
            'lawyer_id' => $request->lawyer_id,
        ]);

        return redirect()->back()->with('success', 'Appointment created successfully');
    }


    public function myprisoners()
    {
        $lawyerId = session('lawyer_id');

        if (!$lawyerId) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $lawyer = Lawyer::find($lawyerId);

        if (!$lawyer) {
            return redirect()->back()->with('error', 'Lawyer not found.');
        }

        $prisoners = $lawyer->assignedPrisoners()->paginate(100);

        return view('lawyer.view_prisoner', compact('prisoners'));
    }

    public function createlegalappo()
    {
        $lawyerId = session('lawyer_id');

        if (!$lawyerId) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        $lawyer = Lawyer::find($lawyerId);

        if (!$lawyer) {
            return redirect()->back()->with('error', 'Lawyer not found.');
        }

        $prisoners = $lawyer->assignedPrisoners()->paginate(100);

        return view('lawyer.create_legal_appointment', compact('prisoners'));
    }

    public function createrequest()
    {
        $lawyerId = session('lawyer_id');

        $prisoners = Prisoner::whereIn('id', function ($query) use ($lawyerId) {
            $query->select('prisoner_id')
                ->from('lawyer_prisoner_assignment')
                ->where('lawyer_id', $lawyerId);
        })->get();

        return view('lawyer.create_request', compact('prisoners'));
    }

    public function createrequestpolice()
    {
        $officerId = session('user_id');

        $prisoners = Prisoner::whereIn('id', function ($query) use ($officerId) {
            $query->select('prisoner_id')
                ->from('police_prisoner_assignment')
                ->where('officer_id', $officerId);
        })->get();

        return view('police_officer.create_request', compact('prisoners'));
    }

    public function viewappointment()
    {
        $lawyerId = session('lawyer_id');

        if (!$lawyerId) {
            return redirect()->route('login')->with('error', 'Unauthorized access. Please log in.');
        }

        $appointments = LawyerAppointment::where('lawyer_id', $lawyerId)->paginate(3);

        if ($appointments->isEmpty()) {
            return view('lawyer.view_appointments')->with('error', 'No appointments found for this lawyer.');
        }

        return view('lawyer.view_appointments', compact('appointments'));
    }

    public function viewrequest()
    {
        $lawyerId = session('lawyer_id');

        if (!$lawyerId) {
            return redirect()->route('login')->with('error', 'Please login as a lawyer');
        }

        $requests = Requests::where('lawyer_id', $lawyerId)
            ->with('prisoner')
            ->paginate(10);

        return view('lawyer.view_requests', compact('requests'));
    }

    public function viewrequestpolice()
    {
        $officerId = session('user_id');

        if (!$officerId) {
            return redirect()->route('login')->with('error', 'Please login as an officer');
        }

        $requests = Requests::where('user_id', $officerId)
            ->with('prisoner')
            ->paginate(10);

        return view('police_officer.view_requests', compact('requests'));
    }

    // View prisoner-related notifications
    public function viewNotifications(Request $request)
    {
        $user = $request->user();
        $role = $user->role_id == 1 ? 'admin' : ($user->role_id == 3 ? 'officer' : ($user->role_id == 4 ? 'lawyer' : 'prisoner'));

        $notifications = Notification::where('recipient_id', $user->user_id)
            ->where('recipient_role', $role)
            ->whereIn('related_table', ['prisoners', 'rooms', 'lawyer_prisoner_assignments', 'police_prisoner_assignments'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json($notifications);
        }

        return view('inspector.notifications', compact('notifications'));
    }

    // Mark a notification as read
    public function markAsRead(Request $request, $notification_id)
    {
        $notification = Notification::where('recipient_id', $request->user()->user_id)
            ->whereIn('related_table', ['lawyer_appointments', 'requests'])
            ->findOrFail($notification_id);
        $notification->is_read = true;
        $notification->save();

        return response()->json(['message' => 'Notification marked as read']);
    }
}
