<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request as FormRequest; // Use FormRequest to handle incoming request
use App\Models\Request as DisciplineRequest; // Alias for custom 'Request' model
use App\Models\RequestEvaluation;


class DisciplineController extends Controller
{
    // Display the request evaluation page
    public function requestEvaluation()
    {
        // Fetch requests that are pending evaluation
        $requests = DisciplineRequest::where('status', 'pending')->get();

        return view('discipline.request_evaluation', compact('requests'));
    }

    // Handle the form submission for evaluating a request
    public function evaluateRequest(FormRequest $request, $id)
    {
        // Find the specific request by ID
        $disciplineRequest = DisciplineRequest::findOrFail($id);

        // Validate the request data
        $validated = $request->validate([
            'evaluation_comments' => 'required|string|max:500',
            'action' => 'required|in:approve,reject', // Ensure action is either 'approve' or 'reject'
        ]);

        // Create or update the request evaluation
        $evaluation = new RequestEvaluation([
            'request_id' => $disciplineRequest->id,
            'comments' => $validated['evaluation_comments'],
            'status' => $validated['action'], // Set status as either 'approve' or 'reject'
        ]);
        
        $evaluation->save();

        // Update the request status based on the action
        $disciplineRequest->status = $validated['action'];
        $disciplineRequest->save();

        // Redirect with a success message
        return redirect()->route('discipline.request_evaluation')->with('success', 'Request has been evaluated successfully!');
    }

    // Display the view requests page
    public function viewRequests()
    {
        // Logic for displaying the view requests page
        return view('discipline.view_requests');
    }

    // Display the assign penalty page
    public function assignPenalty()
    {
        // Logic for displaying the assign penalty page
        return view('discipline.assign_penalty');
    }

    // Display the view penalties page
    public function viewPenalties()
    {
        // Logic for displaying the view penalties page
        return view('discipline.view_penalties');
    }

    // Display the generate reports page
    public function generateReports()
    {
        // Logic for displaying the generate reports page
        return view('discipline.generate_reports');
    }

    // Display the view logs page
    public function viewLogs()
    {
        // Logic for displaying the view logs page
        return view('discipline.view_logs');
    }
}
