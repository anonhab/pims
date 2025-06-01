<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Prisoner;
use App\Models\Requests as RequestModel;
use App\Models\Account;
use App\Models\LawyerAppointment;
use App\Models\Notification;
use App\Models\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function approveLawyerAppointment($id, Request $request)
{
    $appointment = LawyerAppointment::findOrFail($id);
    $appointment->update([
        'status' => 'pending',
        'notes' => $request->input('evaluation', $appointment->notes),
    ]);
    return response()->json(['success' => true, 'message' => 'Appointment approved successfully']);
}

public function rejectLawyerAppointment($id, Request $request)
{
    $appointment = LawyerAppointment::findOrFail($id);
    $appointment->update([
        'status' => 'rejected',
        'notes' => $request->input('evaluation', $appointment->notes),
    ]);
    return response()->json(['success' => true, 'message' => 'Appointment rejected successfully']);
}

public function transferLawyerAppointment($id, Request $request)
{
    $appointment = LawyerAppointment::findOrFail($id);
    $appointment->update([
        'status' => 'transferred',
        'notes' => $request->input('evaluation', $appointment->notes),
    ]);
    return response()->json(['success' => true, 'message' => 'Appointment transferred successfully']);
}
    // Helper method to create prisoner-related notifications
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
    public function dashboard()
    {
        $userId = Session('user_id');
        $prisonId = Session('prison_id');
        $roleId = Session('role_id');

        
      
            // Dashboard Cards
            $activePrisoners = Prisoner::where('prison_id', $prisonId)
                ->where('status', 'Active')
                ->count();

            $pendingRequests = Requests::where('prison_id', $prisonId)
                ->where('status', 'pending')
                ->count();

            $evaluatedRequests = Requests::where('prison_id', $prisonId)
                ->whereIn('status', ['approved', 'rejected', 'transferred'])
                ->count();

            

            // Request Evaluation Trends Chart Data
            $weeklyRequests = Requests::where('prison_id', $prisonId)
                ->where('created_at', '>=', now()->subWeek()->startOfWeek())
                ->select(
                    DB::raw('DAYOFWEEK(created_at) as day'),
                    DB::raw('status'),
                    DB::raw('COUNT(*) as count')
                )
                ->groupBy('day', 'status')
                ->get()
                ->groupBy('status');

            $days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            $approvedData = array_fill(0, 7, 0);
            $pendingData = array_fill(0, 7, 0);
            $rejectedData = array_fill(0, 7, 0);

            foreach ($weeklyRequests as $status => $records) {
                foreach ($records as $record) {
                    $index = $record->day - 1; // DAYOFWEEK: 1=Sun, 7=Sat
                    if ($status === 'approved') {
                        $approvedData[$index] = $record->count;
                    } elseif ($status === 'pending') {
                        $pendingData[$index] = $record->count;
                    } elseif ($status === 'rejected') {
                        $rejectedData[$index] = $record->count;
                    }
                }
            }

            // Recent Activities
            $recentActivities = Notification::where('recipient_id', $userId)
                ->where('recipient_role', 'officer')
                ->where('related_table', 'requests')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            Log::info('Discipline officer dashboard data fetched', [
                'user_id' => $userId,
                'active_prisoners' => $activePrisoners,
                'pending_requests' => $pendingRequests,
                'evaluated_requests' => $evaluatedRequests,
                'recent_activities_count' => $recentActivities->count(),
            ]);

            return view('discipline_officer.dashboard', compact(
                'activePrisoners',
                'pendingRequests',
                'evaluatedRequests',
                'approvedData',
                'pendingData',
                'rejectedData',
                'days',
                'recentActivities'
            ));
       
            Log::error('Error fetching discipline officer dashboard data', [
                'error' => $e->getMessage(),
                'user_id' => $userId
            ]);
          
        
    }

    public function approveRequest(Request $request, $id)
    {
        Log::info('Approve request called for request ID:', ['request_id' => $id]);
    
        $requestData = RequestModel::find($id);
    
        if (!$requestData) {
            Log::warning('Request not found.', ['request_id' => $id]);
            return response()->json(['success' => false, 'message' => 'Request not found!']);
        }
    
        $validatedData = $request->validate([
            'evaluation' => 'required|string|max:1000',
        ]);
    
        Log::info('Evaluation received for approval.', ['evaluation' => $validatedData['evaluation']]);
    
        $requestData->status = 'approved';
        $requestData->approved_by = session('user_id');
        $requestData->evaluation = $validatedData['evaluation'];
        $requestData->save();
    
        $prisoner = Prisoner::find($requestData->prisoner_id);
        $prisonerName = $prisoner ? trim(implode(' ', array_filter([
            $prisoner->first_name,
            $prisoner->middle_name,
            $prisoner->last_name
        ]))) : 'Unknown';
    
        if ($prisoner) {
            $this->createNotification(
                $prisoner->id,
                'prisoner',
                0,
                'requests',
                $requestData->id,
                'Request Approved',
                "prisoner  {$prisoner->first_name} {$prisoner->last_name} request has been approved. Evaluation: {$validatedData['evaluation']}",
                session('prison_id')
            );
        }
    
        $officerId = session('user_id');
        $officerrole = session('role_id');
        if ($officerId) {
            $this->createNotification(
                $officerId,
                'officer',
                $officerrole,
                'requests',
                $requestData->id,
                'Request Approved',
                "You approved a request for {$prisonerName}. Evaluation: {$validatedData['evaluation']}",
                session('prison_id')
            );
        }
    
        Log::info('Request approved successfully.', ['request_id' => $id]);
    
        return response()->json(['success' => true, 'message' => 'Request has been approved successfully!']);
    }
    
    public function transferRequest(Request $request, $id)
{
    Log::info('Transfer request called for request ID:', ['request_id' => $id]);

    $requestData = RequestModel::find($id);

    if (!$requestData) {
        Log::warning('Request not found.', ['request_id' => $id]);
        return response()->json(['success' => false, 'message' => 'Request not found!']);
    }

    $validatedData = $request->validate([
        'evaluation' => 'required|string|max:1000',
    ]);

    Log::info('Evaluation received for transfer.', ['evaluation' => $validatedData['evaluation']]);

    $requestData->status = 'transferred';
    $requestData->prison_id = session('prison_id');
    $requestData->evaluation = $validatedData['evaluation'];
    $requestData->save();

    $prisoner = Prisoner::find($requestData->prisoner_id);
    $prisonerName = $prisoner ? trim(implode(' ', array_filter([
        $prisoner->first_name,
        $prisoner->middle_name,
        $prisoner->last_name
    ]))) : 'Unknown';

    if ($prisoner) {
        $this->createNotification(
            $prisoner->id,
            'prisoner',
            0,
            'requests',
            $requestData->id,
            'Request Transferred',
            "prisoner  {$prisoner->first_name} {$prisoner->last_name}  request has been transferred. Evaluation: {$validatedData['evaluation']}",
            session('prison_id')
        );
    }

    $officerId = session('user_id');
    $officerrole = session('role_id');
    if ($officerId) {
        $this->createNotification(
            $officerId,
            'officer',
            $officerrole,
            'requests',
            $requestData->id,
            'Request Transferred',
            "You transferred a request for {$prisonerName}. Evaluation: {$validatedData['evaluation']}",
            session('prison_id')
        );
    }

    Log::info('Request transferred successfully.', ['request_id' => $id]);

    return response()->json(['success' => true, 'message' => 'Request has been transferred successfully!']);
}




public function rejectRequest(Request $request, $id)
{
    Log::info('Reject request called for request ID:', ['request_id' => $id]);

    $requestData = RequestModel::find($id);

    if (!$requestData) {
        Log::warning('Request not found.', ['request_id' => $id]);
        return response()->json(['success' => false, 'message' => 'Request not found!']);
    }

    $validatedData = $request->validate([
        'evaluation' => 'required|string|max:1000',
    ]);

    Log::info('Evaluation received for rejection.', ['evaluation' => $validatedData['evaluation']]);

    $requestData->status = 'rejected';
    $requestData->evaluation = $validatedData['evaluation'];
    $requestData->save();

    $prisoner = Prisoner::find($requestData->prisoner_id);
    $prisonerName = $prisoner ? trim(implode(' ', array_filter([
        $prisoner->first_name,
        $prisoner->middle_name,
        $prisoner->last_name
    ]))) : 'Unknown';

    if ($prisoner) {
        $this->createNotification(
            $prisoner->id,
            'prisoner',
            0,
            'requests',
            $requestData->id,
            'Request Rejected',
            "prisoner  {$prisoner->first_name} {$prisoner->last_name} request has been rejected. Evaluation: {$validatedData['evaluation']}",
            session('prison_id')
        );
    }

    $officerId = session('user_id');
    $officerrole = session('role_id');


    if ($officerId) {
        $this->createNotification(
            $officerId,
            'officer',
            $officerrole,
            'requests',
            $requestData->id,
            'Request Rejected',
            "You rejected a request for {$prisonerName}. Evaluation: {$validatedData['evaluation']}",
            session('prison_id')
        );
    }

    Log::info('Request rejected successfully.', ['request_id' => $id]);

    return response()->json(['success' => true, 'message' => 'Request has been rejected successfully!']);
}

    public function show_allforin()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);
        return view('discipline_officer.view_prisoner', compact('prisoners'));
    }

    public function showEvaluationForm()
    {
       
        $prisonId = session('prison_id');

        $requests = Requests::where([
            ['status', '=', 'pending'],
            ['prison_id', '=', $prisonId]
        ])->get();
        $prisonId = session('prison_id');

        $lawyerAppointments = LawyerAppointment::where([
            ['status', '=', 'pending'],
            ['prison_id', '=', $prisonId]
        ])->get();
        
       
    
     
        return view('discipline_officer.evaluate_request', compact('requests','lawyerAppointments'));
    }
    public function approve(Request $request, $id) {
        $appointment = LawyerAppointment::findOrFail($id);
        $appointment->status = 'approved';
        $appointment->evaluation = $request->input('evaluation');
        $appointment->save();
        return response()->json(['success' => true]);
    }
    public function reject(Request $request, $id) {
        $appointment = LawyerAppointment::findOrFail($id);
        $appointment->status = 'reject';
        $appointment->evaluation = $request->input('evaluation');
        $appointment->save();
        return response()->json(['success' => true]);
    }
public function show($id)
{
    $prisoner = Prisoner::findOrFail($id);

    return response()->json([
        'id' => $prisoner->id,
        'first_name' => $prisoner->first_name,
        'middle_name' => $prisoner->middle_name,
        'last_name' => $prisoner->last_name,
        'dob' => $prisoner->dob ? Carbon::parse($prisoner->dob)->translatedFormat('F j, Y') : null,
        'gender' => $prisoner->gender,
        'marital_status' => $prisoner->marital_status,
        'crime_committed' => $prisoner->crime_committed,
        'status' => $prisoner->status,
        'time_serve_start' => $prisoner->time_serve_start ? Carbon::parse($prisoner->time_serve_start)->translatedFormat('F j, Y') : null,
        'time_serve_end' => $prisoner->time_serve_end ? Carbon::parse($prisoner->time_serve_end)->translatedFormat('F j, Y') : null,
        'address' => $prisoner->address,
        'emergency_contact_name' => $prisoner->emergency_contact_name,
        'emergency_contact_relation' => $prisoner->emergency_contact_relation,
        'emergency_contact_number' => $prisoner->emergency_contact_number,
        'inmate_image' => $prisoner->inmate_image,
        'prison_id' => $prisoner->prison_id,
        'room_id' => $prisoner->room_id
        
    ]);
}


    // View prisoner-related notifications
    public function viewNotifications(Request $request)
    {
        $userId = session('user_id');
        if (!$userId) {
            Log::warning('User not logged in for viewing notifications');
            return redirect()->route('login')->with('error', 'You need to be logged in to view notifications.');
        }

        $user = Account::where('user_id', $userId)->first();
        if (!$user) {
            Log::warning('User account not found', ['user_id' => $userId]);
            return redirect()->route('login')->with('error', 'User account not found.');
        }

        $role = $user->role_id == 1 ? 'admin' :
                ($user->role_id == 3 ? 'officer' : 'prisoner');

        $notifications = Notification::where('recipient_id', $userId)
            ->where('recipient_role', $role)
            ->where('related_table', 'requests')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json($notifications);
        }

        return view('discipline_officer.notifications', compact('notifications'));
    }

    // Mark a notification as read
    public function markAsRead(Request $request, $notification_id)
    {
        $userId = session('user_id');
        if (!$userId) {
            Log::warning('User not logged in for marking notification as read');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $notification = Notification::where('recipient_id', $userId)
            ->where('related_table', 'requests')
            ->findOrFail($notification_id);
        $notification->is_read = true;
        $notification->save();

        return response()->json(['message' => 'Notification marked as read']);
    }

    // Mark all notifications as read
    public function markAllAsRead(Request $request)
    {
        $userId = session('user_id');
        if (!$userId) {
            Log::warning('User not logged in for marking all notifications as read');
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Account::where('user_id', $userId)->first();
        if (!$user) {
            Log::warning('User account not found', ['user_id' => $userId]);
            return response()->json(['error' => 'User account not found'], 404);
        }

        $role = $user->role_id == 1 ? 'admin' :
                ($user->role_id == 3 ? 'officer' : 'prisoner');

        Notification::where('recipient_id', $userId)
            ->where('recipient_role', $role)
            ->where('related_table', 'requests')
            ->update(['is_read' => true]);

        return response()->json(['message' => 'All notifications marked as read']);
    }
}