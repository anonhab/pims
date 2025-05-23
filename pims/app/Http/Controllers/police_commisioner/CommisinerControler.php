<?php

namespace App\Http\Controllers\police_commisioner;

use App\Http\Controllers\Controller;
use App\Models\Lawyer;
use App\Models\Prisoner;
use App\Models\Request as ModelsRequest;
use App\Models\Account;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CommisinerControler extends Controller
{
    // Helper method to create prisoner-related notifications
    private function createNotification($recipientId, $recipientRole, $relatedTable, $relatedId, $title, $message)
    {
        Notification::create([
            'recipient_id' => $recipientId,
            'recipient_role' => $recipientRole,
            'related_table' => $relatedTable,
            'related_id' => $relatedId,
            'title' => $title,
            'message' => $message,
            'is_read' => false,
        ]);
    }

    public function dashboard()
    {
        $data = [
            'totalPrisoners' => Prisoner::count(),
            'releasedThisMonth' => Prisoner::whereMonth('updated_at', now()->month)->count(),
            'pendingRequests' => ModelsRequest::where('status', 'pending')->count(),
        ];

        return view('police_commisioner.dashboard', $data);
    }

    public function release_prisoner()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);
        return view('police_commisioner.release_form', compact('prisoners'));
    }

    public function releasePrisoner(Request $request)
    {
        // Validate request data
        $request->validate([
            'prisoner_id' => 'required|exists:prisoners,id',
            'sentence_completed' => 'required|accepted',
        ]);

        $prisonerId = $request->input('prisoner_id');
        $prisoner = Prisoner::find($prisonerId);

        if (!$prisoner) {
            Log::error('Prisoner not found', ['prisoner_id' => $prisonerId]);
            return back()->with('error', 'Prisoner not found.');
        }

        $currentDate = now();
        $sentenceEndDate = $prisoner->time_serve_end;

        if ($currentDate >= $sentenceEndDate) {
            $prisoner->status = 'released';
            $prisoner->release_date = now();
            $prisoner->save();

            // Notify prisoner
            $this->createNotification(
                $prisoner->id,
                'prisoner',
                'prisoners',
                $prisoner->id,
                'Prisoner Released',
                "You have been officially released from the prison system."
            );

            // Notify officer (assuming the commissioner is an officer)
            $officerId = session('user_id');
            if ($officerId) {
                $this->createNotification(
                    $officerId,
                    'officer',
                    'prisoners',
                    $prisoner->id,
                    'Prisoner Release Processed',
                    "Prisoner {$prisoner->first_name} {$prisoner->last_name} has been released."
                );
            }

            // Notify admin
            $admin = Account::where('role_id', 1)->first();
            if ($admin) {
                $this->createNotification(
                    $admin->user_id,
                    'admin',
                    'prisoners',
                    $prisoner->id,
                    'Prisoner Released',
                    "Prisoner {$prisoner->first_name} {$prisoner->last_name} has been released from the prison system."
                );
            }

            Log::info('Prisoner released successfully', [
                'prisoner_id' => $prisoner->id,
                'release_date' => $prisoner->release_date,
            ]);

            return back()->with('success', 'Prisoner released successfully.');
        } else {
            Log::warning('Attempted to release prisoner before sentence completion', [
                'prisoner_id' => $prisoner->id,
                'sentence_end_date' => $sentenceEndDate,
            ]);
            return back()->with('error', 'Sentence is not yet completed. Prisoner cannot be released.');
        }
    }

    public function show($id)
    {
        $prisoner = Prisoner::find($id);

        if ($prisoner) {
            return response()->json($prisoner);
        }

        return response()->json(['message' => 'Prisoner not found'], 404);
    }

    public function showEvaluationForm()
    {
        $requests = ModelsRequest::where('status', 'transferred')->get();
        return view('police_commisioner.evaluate_request', compact('requests'));
    }

    public function releasedprisoners()
    {
        $releasedPrisoners = Prisoner::where('prison_id', session('prison_id'))
                                    ->where('status', 'released')
                                    ->paginate(9);
        return view('police_commisioner.Released_Prisoners', compact('releasedPrisoners'));
    }

    public function ExecuteRequests(Request $request)
    {
        // Check if the request contains status updates
        if ($request->has('request_id') && $request->has('status')) {
            $requestId = $request->input('request_id');
            $newStatus = $request->input('status');

            // Validate inputs
            $validator = Validator::make($request->all(), [
                'request_id' => 'required|exists:requests,id',
                'status' => 'required|in:approved,rejected',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $requestRecord = ModelsRequest::find($requestId);
            if (!$requestRecord) {
                Log::error('Request not found', ['request_id' => $requestId]);
                return back()->with('error', 'Request not found.');
            }

            // Update request status
            $requestRecord->status = $newStatus;
            $requestRecord->approved_by = session('user_id') ?: null;
            $requestRecord->save();

            // Get prisoner and requester details
            $prisoner = Prisoner::find($requestRecord->prisoner_id);
            $requester = $requestRecord->lawyer_id ? Lawyer::find($requestRecord->lawyer_id) : Account::find($requestRecord->user_id);
            $requesterRole = $requestRecord->lawyer_id ? 'lawyer' : 'officer';
            $requesterName = $requester ? ($requester->name ?? "{$requester->first_name} {$requester->last_name}") : 'Unknown';

            // Notify prisoner
            $this->createNotification(
                $requestRecord->prisoner_id,
                'prisoner',
                'requests',
                $requestRecord->id,
                "Request {$newStatus}",
                "Your {$requestRecord->request_type} request has been {$newStatus}."
            );

            // Notify requester (lawyer or officer)
            if ($requestRecord->lawyer_id || $requestRecord->user_id) {
                $this->createNotification(
                    $requestRecord->lawyer_id ?: $requestRecord->user_id,
                    $requesterRole,
                    'requests',
                    $requestRecord->id,
                    "Request {$newStatus}",
                    "Your {$requestRecord->request_type} request for prisoner {$prisoner->first_name} {$prisoner->last_name} has been {$newStatus}."
                );
            }

            // Notify admin
            $admin = Account::where('role_id', 1)->first();
            if ($admin) {
                $this->createNotification(
                    $admin->user_id,
                    'admin',
                    'requests',
                    $requestRecord->id,
                    "Request {$newStatus}",
                    "A {$requestRecord->request_type} request for prisoner {$prisoner->first_name} {$prisoner->last_name} has been {$newStatus} by {$requesterName}."
                );
            }

            Log::info('Request status updated', [
                'request_id' => $requestRecord->id,
                'status' => $newStatus,
                'approved_by' => $requestRecord->approved_by,
            ]);

            return back()->with('success', "Request {$newStatus} successfully.");
        }

        // Render view with approved or pending requests
        $approvedRequests = ModelsRequest::whereIn('status', ['approved', 'pending'])->get();
        return view('police_commisioner.process_requests', compact('approvedRequests'));
    }

    // View prisoner-related notifications
    public function viewNotifications(Request $request)
    {
        $user = $request->user();
        $role = $user->role_id == 1 ? 'admin' :
                ($user->role_id == 3 ? 'officer' :
                ($user->role_id == 4 ? 'lawyer' : 'prisoner'));
    
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
            ->whereIn('related_table', ['prisoners', 'requests'])
            ->findOrFail($notification_id);
        $notification->is_read = true;
        $notification->save();

        return response()->json(['message' => 'Notification marked as read']);
    }
}