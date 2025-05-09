<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Prisoner;

use Illuminate\Http\Request;
use App\Models\Request as RequestModel;

class RequestController extends Controller
{
    public function approveRequest(Request $request, $id)
    {
        // Log request start
        Log::info('Approve request called for request ID:', ['request_id' => $id]);

        // Find the request by ID
        $requestData = RequestModel::find($id);

        // Check if request exists
        if (!$requestData) {
            Log::warning('Request not found.', ['request_id' => $id]);
            return response()->json(['success' => false, 'message' => 'Request not found!']);
        }

        // Validate the evaluation input
        $validatedData = $request->validate([
            'evaluation' => 'required|string|max:1000',
        ]);

        // Log the evaluation received
        Log::info('Evaluation received for approval.', ['evaluation' => $validatedData['evaluation']]);

        // Update request status and evaluation
        $requestData->status = 'approved';
        $requestData->approved_by=session('user_id');
        $requestData->evaluation = $validatedData['evaluation'];

        // Save the request with the new data
        $requestData->save();

        // Log the successful approval
        Log::info('Request approved successfully.', ['request_id' => $id]);

        return response()->json(['success' => true, 'message' => 'Request has been approved successfully!']);
    }
    public function transferRequest(Request $request, $id)
    {
        // Log request start
        Log::info('Transfer request called for request ID:', ['request_id' => $id]);

        // Find the request by ID
        $requestData = RequestModel::find($id);

        // Check if request exists
        if (!$requestData) {
            Log::warning('Request not found.', ['request_id' => $id]);
            return response()->json(['success' => false, 'message' => 'Request not found!']);
        }

        // Validate the evaluation input
        $validatedData = $request->validate([
            'evaluation' => 'required|string|max:1000',
        ]);

        // Log the evaluation received
        Log::info('Evaluation received for transfer.', ['evaluation' => $validatedData['evaluation']]);

        // Update request status and evaluation
        $requestData->status = 'transferred';
        $requestData->prison_id = session('prison_id');
        $requestData->evaluation = $validatedData['evaluation'];

        // Save the request with the new data
        $requestData->save();

        // Log the successful transfer
        Log::info('Request transferred successfully.', ['request_id' => $id]);

        return response()->json(['success' => true, 'message' => 'Request has been transferred successfully!']);
    }
    public function showEvaluationForm()
    {
        $requests = RequestModel::where('status', 'pending')->get(); // Adjust query as needed
    
        return view('discipline_officer.evaluate_request', compact('requests'));
    }

    public function rejectRequest(Request $request, $id)
    {
        $requestData = RequestModel::find($id);

        if (!$requestData) {
            return response()->json(['success' => false, 'message' => 'Request not found!']);
        }

        if (empty($request->evaluation)) {
            return response()->json(['success' => false, 'message' => 'Evaluation is required!']);
        }

        $requestData->status = 'rejected';

        $requestData->evaluation = $request->evaluation;
        $requestData->save();

        return response()->json(['success' => true, 'message' => 'Request has been rejected successfully!']);
    }
    public function show($id)
    {
        $prisoner = Prisoner::findOrFail($id);

        return response()->json([
            'id' => $prisoner->id,
            'first_name' => $prisoner->first_name,
            'middle_name' => $prisoner->middle_name,
            'last_name' => $prisoner->last_name,
            'dob' => $prisoner->dob,
            'gender' => $prisoner->gender,
            'marital_status' => $prisoner->marital_status,
            'crime_committed' => $prisoner->crime_committed,
            'status' => $prisoner->status,
            'time_serve_start' => $prisoner->time_serve_start,
            'time_serve_end' => $prisoner->time_serve_end,
            'address' => $prisoner->address,
            'emergency_contact_name' => $prisoner->emergency_contact_name,
            'emergency_contact_relation' => $prisoner->emergency_contact_relation,
            'emergency_contact_number' => $prisoner->emergency_contact_number,
            'inmate_image' => $prisoner->inmate_image,
            'prison_id' => $prisoner->prison_id,
            'room_id' => $prisoner->room_id
        ]);
    }
}
