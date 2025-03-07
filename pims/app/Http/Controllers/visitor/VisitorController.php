<?php

namespace App\Http\Controllers\visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
