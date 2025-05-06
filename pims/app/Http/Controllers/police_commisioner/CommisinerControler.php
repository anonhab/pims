<?php

namespace App\Http\Controllers\police_commisioner;

use App\Models\Prisoner;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;


class CommisinerControler extends Controller
{
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
        $prisoners =Prisoner::where('prison_id', session('prison_id'))->paginate(9);

        return view('police_commisioner.release_form',compact('prisoners'));
    }
    public function releasePrisoner(Request $request) {
        // Get prisoner ID and sentence completed status from the request
        $prisonerId = $request->input('prisoner_id');
        $sentenceCompleted = $request->input('sentence_completed');
        
        // Find the prisoner by ID
        $prisoner = Prisoner::find($prisonerId);
    
        // Check if prisoner exists
        if (!$prisoner) {
            return back()->with('error', 'Prisoner not found.');
        }
    
        // Check if the sentence is completed (this will include a check for the sentence end date)
        if ($sentenceCompleted) {
            // Ensure the current date is greater than or equal to the sentence end date
            $currentDate = now();
            $timeServeEnd = $prisoner->time_serve_end;
    
            // If the sentence is complete, update the prisoner's status
            if ($currentDate >= $timeServeEnd) {
                // Update the prisoner's status to 'released'
                $prisoner->status = 'released';
    
                // Save the updated prisoner record
                $prisoner->save();
    
                return back()->with('success', 'Prisoner released successfully.');
            } else {
                return back()->with('error', 'Sentence is not completed. Prisoner cannot be released.');
            }
        } else {
            // If the checkbox isn't checked, handle the error accordingly
            return back()->with('error', 'Please check if the sentence is completed.');
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
        $requests = ModelsRequest::where('status', 'pending')->get(); // Adjust query as needed
    
        return view('police_commisioner.evaluate_request', compact('requests'));
    }
    
    
    
    public function releasedprisoners()
    {
        $releasedPrisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);
        return view('police_commisioner.Released_Prisoners', compact('releasedPrisoners'));
    }

    public function ExecuteRequests()
    {
        $approvedRequests = Request::where('status', 'approved')->orWhere('status', 'pending')->get();
        return view('police_commisioner.process_requests', compact('approvedRequests'));
    }
}
