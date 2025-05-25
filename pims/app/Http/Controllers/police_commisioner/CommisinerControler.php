<?php

namespace App\Http\Controllers\police_commisioner;

use App\Http\Controllers\Controller;
use App\Models\Lawyer;
use App\Models\Prisoner;
use App\Models\Request as ModelsRequest;
use App\Models\Account;
use App\Models\Notification;
use App\Models\Prison;
use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CommisinerControler extends Controller
{
    // Updated helper method with roleId and prisonId
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

            $prisonId = $prisoner->prison_id;

            // Notify prisoner
            $this->createNotification(
                $prisoner->id,
                'prisoner',
                5, // Assuming role_id 5 = prisoner
                'prisoners',
                $prisoner->id,
                'Prisoner Released',
                "You have been officially released from the prison system.",
                $prisonId
            );

            // Notify officer (the commissioner)
            $officerId = session('user_id');
            if ($officerId) {
                $this->createNotification(
                    $officerId,
                    'officer',
                    3, // Assuming role_id 3 = officer
                    'prisoners',
                    $prisoner->id,
                    'Prisoner Release Processed',
                    "Prisoner {$prisoner->first_name} {$prisoner->last_name} has been released.",
                    $prisonId
                );
            }

            // Notify admin
            $admin = Account::where('role_id', 1)->first();
            if ($admin) {
                $this->createNotification(
                    $admin->user_id,
                    'admin',
                    1, // role_id 1 = admin
                    'prisoners',
                    $prisoner->id,
                    'Prisoner Released',
                    "Prisoner {$prisoner->first_name} {$prisoner->last_name} has been released from the prison system.",
                    $prisonId
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
        $prisons =  Prison::all();
        $prisonId = session('prison_id');

        $requests = Requests::where('status', 'transferred')
            ->whereHas('prisoner', function ($query) use ($prisonId) {
                $query->where('prison_id', $prisonId);
            })
            ->get();



        return view('police_commisioner.evaluate_request', compact('requests', 'prisons'));
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
        if ($request->has('request_id') && $request->has('status')) {
            $requestId = $request->input('request_id');
            $newStatus = $request->input('status');

            $validator = Validator::make($request->all(), [
                'request_id' => 'required|exists:requests,id',
                'status' => 'required|in:approved,rejected',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $requestRecord = Requests::find($requestId);
            if (!$requestRecord) {
                Log::error('Request not found', ['request_id' => $requestId]);
                return back()->with('error', 'Request not found.');
            }

            $requestRecord->status = $newStatus;
            $requestRecord->approved_by = session('user_id') ?: null;
            $requestRecord->save();

            $prisoner = Prisoner::find($requestRecord->prisoner_id);
            $requester = $requestRecord->lawyer_id ? Lawyer::find($requestRecord->lawyer_id) : Account::find($requestRecord->user_id);
            $requesterRole = $requestRecord->lawyer_id ? 'lawyer' : 'officer';
            $requesterRoleId = $requestRecord->lawyer_id ? null : 8; // 4=lawyer, 3=officer
            $requesterName = $requester ? ($requester->name ?? "{$requester->first_name} {$requester->last_name}") : 'Unknown';
            $prisonId = $prisoner->prison_id ?? session('prison_id');

           
            // Notify requester
            if ($requestRecord->lawyer_id || $requestRecord->user_id) {
                $this->createNotification(
                    $requestRecord->lawyer_id ?: $requestRecord->user_id,
                    $requesterRole,
                    $requesterRoleId,
                    'requests',
                    $requestRecord->id,
                    "Request {$newStatus}",
                    "Your {$requestRecord->request_type} request for prisoner {$prisoner->first_name} {$prisoner->last_name} has been {$newStatus}.",
                    $prisonId
                );
            }

           
            Log::info('Request status updated', [
                'request_id' => $requestRecord->id,
                'status' => $newStatus,
                'approved_by' => $requestRecord->approved_by,
            ]);

            return back()->with('success', "Request {$newStatus} successfully.");
        }

        $approvedRequests = ModelsRequest::whereIn('status', ['approved', 'pending'])->get();
        return view('police_commisioner.process_requests', compact('approvedRequests'));
    }

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

    public function markAsRead(Request $request, $notification_id)
    {
        $notification = Notification::where('recipient_id', $request->user()->user_id)
            ->whereIn('related_table', ['prisoners', 'requests'])
            ->findOrFail($notification_id);
        $notification->is_read = true;
        $notification->save();

        return response()->json(['message' => 'Notification marked as read']);
    }
    public function approve(Request $request)
{
    // Log incoming request
    Log::info('Transfer approval request received', $request->all());

    // Log validation
    Log::info('Validation passed', [
        'request_id'  => $request->request_id,
        'prisoner_id' => $request->prisoner_id,
        'facility_id' => $request->facility_id,
    ]);

    // Retrieve models
    $transferRequest = \App\Models\Requests::findOrFail($request->request_id);
    $prisoner = \App\Models\Prisoner::findOrFail($request->prisoner_id);

    Log::info('Fetched transfer request and prisoner', [
        'transfer_request' => $transferRequest->toArray(),
        'prisoner' => $prisoner->toArray(),
    ]);

    // Update prisoner's current facility
    $prisoner->prison_id = $request->facility_id;
    $prisoner->room_id = null;
    $prisoner->save();

    Log::info('Prisoner updated with new facility', [
        'prisoner_id' => $prisoner->id,
        'new_prison_id' => $request->facility_id,
    ]);

    // Approve transfer request
    $transferRequest->status = 'approved';
    $transferRequest->approved_by = session('user_id');
    $transferRequest->save();

    Log::info('Transfer request marked as approved', [
        'request_id' => $transferRequest->id,
        'approved_by' => session('user_id')
    ]);

    // Notify the prisoner
    $this->createNotification(
        $prisoner->id,
        'prisoner',
        0,
        'requests',
        $transferRequest->id,
        'Transfer Approved',
        "Prisoner { $prisoner->first_name} {$prisoner->last_name} transfer request has been approved. You have been moved to a new facility.",
        session('prison_id')
    );

    return redirect()->back()->with('success', 'Prisoner transfer approved successfully.');
}

}
