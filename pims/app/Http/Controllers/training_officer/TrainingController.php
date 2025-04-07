<?php

namespace App\Http\Controllers\training_officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingProgram;
use App\Models\Prisoner;
use App\Models\TrainingAssignment;

use App\Models\JobAssignment;

class TrainingController extends Controller
{
    // Show form to assign certifications
    public function assignCertifications()
    {
        return view('training_officer.assignCertifications');
    }

    // Store the assigned certifications
    public function storeCertifications(Request $request)
    {
        // Logic to save certifications to the database
        // Example: Certification::create($request->all());

        return redirect()->route('training_officer.viewCertifications')->with('success', 'Certifications assigned successfully');
    }

    // Show form to assign jobs
    public function assignJobs()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->get();
    
        return view('training_officer.assignJobs', compact('prisoners'));
    }
    

    public function assignJob(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'prisoner_id' => 'required|exists:prisoners,id',
            'job_title' => 'required|string|max:100',
            'assigned_date' => 'required|date',
            'status' => 'required|in:active,completed,terminated',
            'job_description' => 'nullable|string',
        ]);
    
        // Create the job assignment record
        JobAssignment::create([
            'prisoner_id' => $validated['prisoner_id'],
            'assigned_by' => session('user_id'),
            'job_title' => $validated['job_title'],
            'assigned_date' => $validated['assigned_date'],
            'status' => $validated['status'],
            'job_description' => $validated['job_description'] ?? null,
        ]);
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Job assigned successfully.');
    }
    
    // Store the assigned jobs
    public function storeJobs(Request $request)
    {
        // Logic to save jobs to the database
        // Example: Job::create($request->all());

        return redirect()->route('training_officer.viewJobs')->with('success', 'Jobs assigned successfully');
    }

    // Show form to create training programs
    public function createTrainingPrograms()
    {
        return view('training_officer.createTrainingPrograms');
    }

    public function assignTrainingPrograms()
    {
        // Retrieve prisoners who are not yet assigned to any training program
        $prisoners = Prisoner::where('prison_id', session('prison_id'))
            ->whereDoesntHave('trainingAssignments') // Assumes the prisoner model has a trainingAssignments relationship
            ->get();
        $programs = TrainingProgram::where('prison_id', session('prison_id'))->get();
         // Fetch training assignments with the related training program
    $assignments = TrainingAssignment::with('trainingProgram')->get();

        return view('training_officer.assignTrainingPrograms', compact('prisoners', 'programs','assignments'));
    }
    public function viewAssignedPrograms()
{
    // Fetch the training assignments where prison_id matches session's prison_id
    $assignments = TrainingAssignment::whereHas('prisoner', function ($query) {
        $query->where('prison_id', session('prison_id'));
    })->get();

    return view('training_officer.viewAssignedPrograms', compact('assignments'));
}

// Assuming you're using AssignedTraining model
public function unassignTrainingProgram($id)
{
    // Find the assignment by ID
    $assignment = TrainingAssignment::findOrFail($id);

    // Clear the prisoner_id or training_id, or you could change the status to 'unassigned'
    $assignment->update([
        'prisoner_id' => null,
        'training_id' => null,
        'status' => null, // or any status you prefer
    ]);

    // Redirect with success message
    return redirect()->back()->with('success', 'Training program unassigned successfully.');
}


    public function storeTrainingProgram(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'created_by' => 'nullable|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Add prison_id from session
        $data['prison_id'] = session('prison_id');

        TrainingProgram::create($data);

        return redirect()->back()->with('success', 'Training program created successfully.');
    }


    public function assignTrainingProgram(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'prisoner_id' => 'required|exists:prisoners,id',
            'training_id' => 'required|exists:training_programs,id',
            'assigned_date' => 'required|date',
            'status' => 'required|in:in_progress,completed',
        ]);

        // Add prison_id from session (assuming it's stored in the session)
        $data['assigned_by'] = session('user_id');

        // Create the training assignment
        TrainingAssignment::create($data);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Training program assigned successfully.');
    }



    public function updatejob(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required|exists:job_assignments,id',
            'prisoner_id' => 'required|exists:prisoners,id',
            'job_title' => 'required|string|max:100',
            'job_description' => 'nullable|string',
            'assigned_date' => 'required|date',
            'status' => 'required|in:active,completed,terminated',
        ]);
    
        $job = JobAssignment::findOrFail($validated['job_id']);
        $job->update([
            'prisoner_id' => $validated['prisoner_id'],
            'assigned_by' => session('user_id'),
            'job_title' => $validated['job_title'],
            'job_description' => $validated['job_description'],
            'assigned_date' => $validated['assigned_date'],
            'status' => $validated['status'],
        ]);
    
        return redirect()->back()->with('success', 'Job updated successfully.');
    }
    
    // View list of certifications
    public function viewCertifications()
    {
        // Fetch the certifications from the database
        // Example: $certifications = Certification::all();

        return view('training_officer.viewCertifications');
    }

    // View list of jobs
    public function viewJobs()
    {
        // Fetch the jobs from the database
        $jobs = JobAssignment::paginate(9);

        return view('training_officer.viewJobs', compact('jobs'));
    }

    // View list of training programs
    public function viewTrainingPrograms()
    {
        $trainingprograms = TrainingProgram::paginate(9);

        return view('training_officer.viewTrainingPrograms', compact('trainingprograms'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'created_by' => 'nullable|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $trainingProgram = TrainingProgram::findOrFail($id); // Find the training program by id
        $trainingProgram->update($data); // Update the training program with new data

        return redirect()->back()->with('success', 'Training program updated successfully.');
    }
    public function destroy($id)
    {
        $trainingProgram = TrainingProgram::findOrFail($id);
        $trainingProgram->delete();

        return redirect()->back()->with('success', 'Training program deleted successfully.');
    }public function destroyjob(JobAssignment $job) // Type-hint the Job model
    {
        $job->delete();
        return redirect()->back()->with('success', 'Job deleted successfully');
    }
}
