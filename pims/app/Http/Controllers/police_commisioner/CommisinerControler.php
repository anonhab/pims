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
    public function releasePrisoner(Request $request)
    {
        // Retrieve prisoner ID and sentence completion status from the request
        $prisonerId = $request->input('prisoner_id');
        $sentenceCompleted = $request->input('sentence_completed');
    
        // Attempt to find the prisoner by ID
        $prisoner = Prisoner::find($prisonerId);
    
        // Check if the prisoner exists
        if (!$prisoner) {
            return back()->with('error', 'Prisoner not found.');
        }
    
        // Check if the sentence completion checkbox is checked
        if (!$sentenceCompleted) {
            return back()->with('error', 'Please confirm that the sentence is completed.');
        }
    
        // Check if the current date is on or after the sentence end date
        $currentDate = now();
        $sentenceEndDate = $prisoner->time_serve_end;
    
        if ($currentDate >= $sentenceEndDate) {
            // Update prisoner status to 'released' and set release date
            $prisoner->status = 'released';
            $prisoner->release_date = now();
            $prisoner->save();
    
            return back()->with('success', 'Prisoner released successfully.');
        } else {
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
        $requests = ModelsRequest::where('status', 'transferred')->get(); // Adjust query as needed
    
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
