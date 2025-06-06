<?php

namespace App\Http\Controllers\visitor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\VisitingTimeRequestController;
use App\Models\NewVisitingRequest;
use App\Models\Prison;
use App\Models\Prisoner;
use App\Models\VisitingRequest;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class VisitorController extends Controller
{
    public function createVisitingRequest()
    {
        // Logic to retrieve all the visiting time requests from the database
        // Example: $requests = VisitingRequest::all();

        return view('visitor.createVisitingTimeRequest');  // Return the view to display the requests
    }
    // Method to create a visiting time request
    public function createVisitingTimeRequest(Request $request)
    {
        // Logic to create a visiting time request
        // For example, validating the request and storing it in the database

        return redirect()->route('visitor.createVisitingTimeRequest')->with('success', 'Visiting time request created successfully.');
    }

    // Method to view visiting requests
    public function viewVisitingRequests()
    {
        // Logic to retrieve all the visiting time requests from the database
        // Example: $requests = VisitingRequest::all();

        return view('visitor.my_visiting_time_requests', compact('requests'));  // Return the view to display the requests
    }
    public function showRegistrationForm()
    {
        return view('visitor.register_visitor');
    }

    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'relationship' => 'required|string|max:255',
            'address' => 'required|string',
            'identification_number' => 'required|string|unique:visitors',
            'email' => 'required|email|unique:visitors',
            'password' => 'required|min:6',
        ]);
    
        // Create the visitor
        $visitor = Visitor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'relationship' => $request->relationship,
            'address' => $request->address,
            'identification_number' => $request->identification_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    
        // Log the visitor registration
        Log::info('New visitor registered:', [
            'visitor_id' => $visitor->id,
            'name' => $visitor->first_name . ' ' . $visitor->last_name,
            'email' => $visitor->email,
            'created_at' => $visitor->created_at,
        ]);
    
        // Redirect to the login page with success message
        return redirect()->route('login')->with('success', 'Visitor registered successfully! Please login.');
    }
    
    public function dashboard()
    {
        return view('visitor.dashboard');
    }
    
    public function createVisiting()
    {
            // Fetch all prisons
    $prisons = Prison::all();
        return view('visitor.createVisitingTimeRequest',compact('prisons'));
    }
    public function submitRequest(Request $request)
{
    Log::info('Visiting Request Submission Started', [
        'visitor_id' => Session::get('visitor_id'),
        'input' => $request->all(),
    ]);

    $request->validate([
        'requested_date' => 'required|date',
        'requested_time' => 'required',
        'prisoner_firstname' => 'required|string|max:255',
        'prisoner_middlename' => 'required|string|max:255',
        'prisoner_lastname' => 'required|string|max:255',
        'prison_id' => 'required|exists:prisons,id',
    ]);

    $visitor_id = Session::get('visitor_id');

    if (!$visitor_id) {
        Log::warning('Visitor is not logged in');
        return redirect()->route('visitor.login')->with('error', 'You need to be logged in to submit a request.');
    }

    // Check for duplicates
    $existing = NewVisitingRequest::where('visitor_id', $visitor_id)
        ->where('requested_date', $request->requested_date)
        ->where('requested_time', $request->requested_time)
        ->where('prisoner_firstname', $request->prisoner_firstname)
        ->where('prisoner_middlename', $request->prisoner_middlename)
        ->where('prisoner_lastname', $request->prisoner_lastname)
        ->where('prison_id', $request->prison_id)
        ->whereIn('status', ['pending', 'approved']) // Optional: consider only active ones
        ->first();

    if ($existing) {
        return back()->with('error', 'You have already submitted a request for the same prisoner at that date and time.');
    }

    // Create the request
    $visitingRequest = new NewVisitingRequest();
    $visitingRequest->visitor_id = $visitor_id;
    $visitingRequest->requested_date = $request->requested_date;
    $visitingRequest->requested_time = $request->requested_time;
    $visitingRequest->status = $request->status ?? 'pending';
    $visitingRequest->prisoner_firstname = $request->prisoner_firstname;
    $visitingRequest->prisoner_middlename = $request->prisoner_middlename;
    $visitingRequest->prisoner_lastname = $request->prisoner_lastname;
    $visitingRequest->prison_id = $request->prison_id;
    $visitingRequest->save();

    Log::info('Visiting Request Submitted Successfully', [
        'visitor_id' => $visitor_id,
        'visiting_request_id' => $visitingRequest->id,
    ]);

    return back()->with('success', 'Visiting Request Submitted Successfully');
}

    
 

public function getPrisonersByPrison($prisonId)
{
    // Fetch prisoners by selected prison
    $prisoners = Prisoner::where('prison_id', $prisonId)->get();

    // Return prisoners as JSON
    return response()->json($prisoners);
}
public function viewRequests()
{
    $prisons = Prison::all();
    // Fetch the visitor's submitted visiting requests
    $visitor_id = Session::get('visitor_id');
    $visitingRequests = NewVisitingRequest::where('visitor_id', $visitor_id)
    ->paginate(9);

    return view('visitor.my_visiting_time_requests', compact('visitingRequests','prisons'));
}
public function resubmitRequest(Request $request, $id)
{
    // Validate note
    $request->validate([
        'note' => 'required|string|max:255',
    ]);

    // Find the visiting request by ID
    $visitingRequest = NewVisitingRequest::findOrFail($id);

    // Update the status and add note
    $visitingRequest->status = 'pending';  // Reset to pending
    $visitingRequest->note = $request->note;
    $visitingRequest->save();

    // Redirect back with success message
    return redirect()->route('visitor.visitingRequests')->with('success', 'Visiting Request has been resubmitted for approval');
}


}
