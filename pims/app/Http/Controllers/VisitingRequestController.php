// app/Http/Controllers/VisitingTimeController.php
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitingTimeRequest;  
use App\Models\Prisoner;  
use App\Models\Visitor;  

class VisitingRequestController extends Controller
{
    public function create()
    {
        // Fetch all registered prisoners and visitors
        $prisoners = Prisoner::all();  // Get all prisoners from the database
        $visitors = Visitor::all();  // Get all visitors from the database

        // Return the view with the prisoners and visitors data
        return view('security_officer.visiting_request', compact('prisoners', 'visitors'));
    }

    public function store(Request $request)
    {
        // Validate the incoming form data
        $validatedData = $request->validate([
            'visitor_id' => 'required|exists:visitors,id',
            'prisoner_id' => 'required|exists:prisoners,id',
            'requested_date' => 'required|date',
            'status' => 'required|string',
            'approved_by' => 'nullable|string',
        ]);

        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Visiting time request submitted successfully!');
    }
}
