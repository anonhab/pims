<?php

namespace App\Http\Controllers\police_commisioner;

use App\Models\Prisoner;

use App\Http\Controllers\Controller;
use App\Models\Prison;
use App\Models\Request as ModelsRequest;
use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function approve(Request $request)
    {
        // Log incoming request
        Log::info('Transfer approval request received', $request->all());

        // Validate input


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

        return redirect()->back()->with('success', 'Prisoner transfer approved successfully.');
    }

    public function release_prisoner()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);

        return view('police_commisioner.release_form', compact('prisoners'));
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
        $releasedPrisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);
        return view('police_commisioner.Released_Prisoners', compact('releasedPrisoners'));
    }

    public function ExecuteRequests()
    {
        $approvedRequests = Request::where('status', 'approved')->orWhere('status', 'pending')->get();
        return view('police_commisioner.process_requests', compact('approvedRequests'));
    }
}
