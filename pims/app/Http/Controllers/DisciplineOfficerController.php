<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\UserRequest;  // Updated model name
use App\Models\Penalty;
use App\Models\Report;
use App\Models\Log;
use App\Models\Request;

class DisciplineOfficerController extends Controller
{
    // Show form to evaluate requests
    public function evaluateRequest(Request $request, $id)
    {
        // Find the request by its ID
        $requestToEvaluate = Request::findOrFail($id);
    
        // Validate the input if necessary
        $validated = $request->validate([
            'evaluation' => 'required|string|max:255',
            'penalty' => 'nullable|string|max:255', // Optional field for penalty
        ]);
    
        // Update the request with evaluation and penalty
        $requestToEvaluate->evaluation = $validated['evaluation']; // Store the evaluation
        $requestToEvaluate->penalty = $validated['penalty'] ?? null; // Store the penalty (if any)
        $requestToEvaluate->status = 'evaluated'; // Change the status to evaluated
        $requestToEvaluate->save(); // Save the changes in the database
    
        // Redirect back with a success message
        return redirect()->route('discipline_officer.view_requests')->with('success', 'Request evaluated successfully.');
    }
    
    // Store evaluated request status
    // Show the evaluation form (GET request)
    public function showEvaluationForm()
    {
        $requests = Request::where('status', 'pending')->get(); // Adjust query as needed
    
        return view('discipline_officer.evaluate_request', compact('requests'));
    }
    

// Handle form submission (POST request)
public function evaluate(Request $request)
{
    // Validate request data
    $request->validate([
        'request_id' => 'required|integer|exists:requests,id',
        'status' => 'required|string|in:approved,rejected,pending',
    ]);

    // Find the request and update its status
    $evaluationRequest = RequestModel::find($request->request_id); // Ensure the model is correct
    $evaluationRequest->status = $request->status;
    $evaluationRequest->save();

    return response()->json(['message' => 'Request evaluated successfully!']);
}


    // Show form to assign penalties
    public function assignPenalty()
    {
        return view('discipline_officer.assign_penalty');
    }

    // Store the assigned penalties
    public function storePenalty(Request $request)
    {
        Penalty::create($request->all());

        return redirect()->route('discipline_officer.view_penalties')->with('success', 'Penalty assigned successfully');
    }

    // View list of penalties
    public function viewPenalties()
    {
        $penalties = Penalty::paginate(9);
        return view('discipline_officer.view_penalties', compact('penalties'));
    }

    // Show form to generate reports
    public function generateReports()
    {
        return view('discipline_officer.generate_reports');
    }

    // Store the generated reports
    public function storeReports(Request $request)
    {
        Report::create($request->all());

        return redirect()->route('discipline_officer.view_reports')->with('success', 'Report generated successfully');
    }

    // View list of reports
    public function viewReports()
    {
        $reports = Report::paginate(9);
        return view('discipline_officer.view_reports', compact('reports'));
    }

    // View logs
    public function viewLogs()
    {
        $logs = Log::paginate(9);
        return view('discipline_officer.view_logs', compact('logs'));
    }
}
