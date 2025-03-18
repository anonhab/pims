<?php

namespace App\Http\Controllers\lawyer;

use App\Http\Controllers\Controller;
use App\Models\LawyerAppointment;
use App\Models\Requests;
use App\Models\Prisoner;
use App\Models\Account;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use App\Models\LawyerPrisonerAssignment;

use App\Models\Lawyer;

class myLawyerController extends Controller
{
    public function ldashboard()
    {
        $prisoners = Prisoner::all();
        return view('lawyer.dashboard', compact('prisoners'));
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

        Log::info("Session Data: ", ['lawyer_id' => $lawyerId, 'user_id' => $userId]);

        // Create the request record
        $requestData = [
            'lawyer_id' => $lawyerId ?: null,
            'user_id' => $userId ?: null,
            'request_type' => $request->request_type,
            'status' => $request->status,
            'approved_by' => $request->approved_by ?: null, // Set NULL if empty
            'request_details' => $request->request_details,
            'prisoner_id' => $request->prisoner_id,
        ];
        // Fetch all users with role_id = 5
        $users = Account::where('role_id', 2)->pluck('user_id');

        // Insert notifications for each user
        foreach ($users as $userId) {
            Notification::create([
                'account_id' => $userId,
                'message' => "New request: " . $request->request_type,
                'status' => 'unread',
            ]);
        }

        Log::info("Insert Data: ", $requestData);

        $requestRecord = Requests::create($requestData);

        if ($requestRecord) {
            Log::info("Request successfully inserted with ID: " . $requestRecord->id);
        } else {
            Log::error("Request insertion failed.");
        }

        return redirect()->back()->with('success', 'Request submitted successfully.');
    }

    public function astore(Request $request)
    {
        // Create the lawyer appointment
        LawyerAppointment::create([
            'prisoner_id' => $request->prisoner_id,
            'lawyer_id' => $request->lawyer_id,
            'appointment_date' => $request->appointment_date,
            'status' => 'scheduled', // Default status
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Appointment created successfully');
    }
    public function myprisoners()
    {
        // Get the logged-in lawyer's ID from the session
        $lawyerId = session('lawyer_id');

        // Check if a lawyer is logged in
        if (!$lawyerId) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Fetch the lawyer based on the session ID
        $lawyer = Lawyer::find($lawyerId);

        // If lawyer is not found, return an error
        if (!$lawyer) {
            return redirect()->back()->with('error', 'Lawyer not found.');
        }

        // Fetch only prisoners assigned to this lawyer
        $prisoners = $lawyer->assignedPrisoners()->paginate(100);

        return view('lawyer.view_prisoner', compact('prisoners'));
    }



    public function createlegalappo()
    {
         
        $lawyerId = session('lawyer_id');

        // Check if a lawyer is logged in
        if (!$lawyerId) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Fetch the lawyer based on the session ID
        $lawyer = Lawyer::find($lawyerId);

        // If lawyer is not found, return an error
        if (!$lawyer) {
            return redirect()->back()->with('error', 'Lawyer not found.');
        }

        // Fetch only prisoners assigned to this lawyer
        $prisoners = $lawyer->assignedPrisoners()->paginate(100);

        return view('lawyer.create_legal_appointment', compact('prisoners'));
    }

    public function createrequest()
    {
        $lawyerId = session('lawyer_id'); // Get the logged-in lawyer's ID from session

        // Fetch prisoners assigned to this lawyer
        $prisoners = Prisoner::whereIn('id', function ($query) use ($lawyerId) {
            $query->select('prisoner_id')
                ->from('lawyer_prisoner_assignment')
                ->where('lawyer_id', $lawyerId);
        })->get();
        return view('lawyer.create_request', compact('prisoners'));
    }

    public function viewappointment()
    {
       // Get the logged-in lawyer's ID from the session
    $lawyerId = session('lawyer_id');

    // Check if the lawyer is logged in
    if (!$lawyerId) {
        return redirect()->route('login')->with('error', 'Unauthorized access. Please log in.');
    }

    // Fetch the lawyer's appointments from the lawyer_appointments table using the lawyer_id from the session
    $appointments = LawyerAppointment::where('lawyer_id', $lawyerId)
                                      ->paginate(3);  // You can adjust the number of appointments per page as needed

    // If no appointments are found for the lawyer, return a message
    if ($appointments->isEmpty()) {
        return view('lawyer.view_appointments')->with('error', 'No appointments found for this lawyer.');
    }

    // Pass the appointments data to the view
    return view('lawyer.view_appointments', compact('appointments'));
    }
    public function viewrequest()
    {
        // Retrieve the lawyer_id from the session
        $lawyer_id = session('lawyer_id');
    
        // If the lawyer_id is not found in the session, you can redirect or show an error.
        if (!$lawyer_id) {
            return redirect()->route('login')->with('error', 'Please login as a lawyer');
        }
    
        // Retrieve the requests associated with this lawyer_id
        $requests = Requests::where('lawyer_id', $lawyer_id)
                           ->with('prisoner') // Assuming Request has a 'prisoner' relationship
                           ->paginate(10); // Adjust the number of items per page as needed
    
        return view('lawyer.view_requests', compact('requests'));
    }
    
}