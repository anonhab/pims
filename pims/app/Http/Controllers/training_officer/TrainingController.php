<?php

namespace App\Http\Controllers\training_officer;

use App\Http\Controllers\Controller;
use App\Models\CertificationRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\TrainingProgram;
use App\Models\Prisoner;
use App\Models\TrainingAssignment;
use OwenIt\Auditing\Models\Audit;

use App\Models\JobAssignment;
use Illuminate\Support\Facades\Log;

class TrainingController extends Controller
{
    // Show form to assign certifications

    /**
     * Escape special characters for HTML.
     *
     * @param string|null $string
     * @return string
     */
    protected function escapeHtml($string)
    {
        return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
    }

    public function assignCertifications()
    {
        $prisonId = session('prison_id');

        $prisoners = Prisoner::where('prison_id', $prisonId)
            ->where(function ($query) {
                $query->whereHas('jobAssignments', function ($q) {
                    $q->where('status', 'completed');
                })->orWhereHas('trainingAssignments', function ($q) {
                    $q->where('status', 'completed');
                });
            })
            ->select('id', 'first_name', 'middle_name', 'last_name')
            ->get();

        $prisonerDetails = $prisoners->map(function ($prisoner) {
            return [
                'id' => $prisoner->id,
                'first_name' => $prisoner->first_name,
                'middle_name' => $prisoner->middle_name,
                'last_name' => $prisoner->last_name,
            ];
        })->toArray();

        return view('training_officer.assignCertifications', compact('prisonerDetails'));
    }

    public function getPrisonerDetails(Request $request)
    {
        $prisonerId = $request->input('prisoner_id');
        $prisonId = session('prison_id');

        if (!$prisonerId || !$prisonId) {
            return response()->json(['error' => 'Invalid prisoner or prison ID'], 400);
        }

        $prisoner = Prisoner::where('id', $prisonerId)
            ->where('prison_id', $prisonId)
            ->with([
                'jobAssignments' => function ($query) {
                    $query->where('status', 'completed')
                        ->select('id', 'prisoner_id', 'job_title', 'job_description', 'end_date');
                },
                'trainingAssignments' => function ($query) {
                    $query->where('status', 'completed')
                        ->select('id', 'prisoner_id', 'training_id', 'end_date');
                },
                'trainingAssignments.trainingProgram' => function ($query) {
                    $query->select('id', 'title');
                }
            ])
            ->select('id', 'first_name', 'middle_name', 'last_name')
            ->first();

        if (!$prisoner) {
            return response()->json(['error' => 'Prisoner not found'], 404);
        }

        $details = [
            'id' => $prisoner->id,
            'full_name' => trim(implode(' ', array_filter([
                $prisoner->first_name,
                $prisoner->middle_name,
                $prisoner->last_name
            ]))),
            'completed_jobs' => $prisoner->jobAssignments->map(function ($job) {
                return [
                    'job_title' => $job->job_title,
                    'job_description' => $job->job_description ?? 'No description available',
                    'completed_date' => $job->end_date->format('M d, Y'),
                ];
            })->toArray(),
            'completed_trainings' => $prisoner->trainingAssignments->map(function ($training) {
                return [
                    'training_title' => optional($training->trainingProgram)->title ?? 'Unknown Training',
                    'completed_date' => $training->end_date->format('M d, Y'),
                ];
            })->toArray()
        ];

        return response()->json($details);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prisoner_id' => 'required|exists:prisoners,id',
            'certification_type' => 'required|in:job_completion,training_program_completion',
            'certification_details' => 'nullable|string|max:65535',
            'issued_by' => 'required|exists:accounts,user_id',
            'issued_date' => 'required|date',
        ]);

        $prisonId = session('prison_id');

        $prisoner = Prisoner::where('id', $validated['prisoner_id'])
            ->where('prison_id', $prisonId)
            ->with([
                'jobAssignments' => function ($query) {
                    $query->where('status', 'completed')
                        ->select('id', 'prisoner_id', 'job_title', 'job_description', 'end_date');
                },
                'trainingAssignments' => function ($query) {
                    $query->where('status', 'completed')
                        ->select('id', 'prisoner_id', 'training_id', 'end_date');
                },
                'trainingAssignments.trainingProgram' => function ($query) {
                    $query->select('id', 'title');
                }
            ])
            ->select('id', 'first_name', 'middle_name', 'last_name')
            ->firstOrFail();

        $certification = CertificationRecord::create([
            'prisoner_id' => $validated['prisoner_id'],
            'issued_by' => $validated['issued_by'],
            'certification_type' => $validated['certification_type'],
            'certification_details' => $validated['certification_details'],
            'issued_date' => $validated['issued_date'],
            'status' => 'issued',
        ]);

        $prisonerName = trim(implode(' ', array_filter([
            $prisoner->first_name,
            $prisoner->middle_name,
            $prisoner->last_name
        ])));

        $data = [
            'prisoner_name' => $this->escapeHtml($prisonerName),
            'certification_type' => $validated['certification_type'] === 'job_completion' ? 'Job Completion' : 'Training Program Completion',
            'certification_details' => $this->escapeHtml($validated['certification_details'] ?? 'No additional details provided.'),
            'issued_by' => $this->escapeHtml(trim(session('first_name') . ' ' . session('last_name'))),
            'issued_date' => \Carbon\Carbon::parse($certification->issued_date)->format('F d, Y'),
            'completed_jobs' => $prisoner->jobAssignments->map(function ($job) {
                return [
                    'job_title' => $this->escapeHtml($job->job_title),
                    'completed_date' => $job->end_date->format('M d, Y'),
                ];
            })->toArray(),
            'completed_trainings' => $prisoner->trainingAssignments->map(function ($training) {
                return [
                    'training_title' => $this->escapeHtml(optional($training->trainingProgram)->title ?? 'Unknown Training'),
                    'completed_date' => $training->end_date->format('M d, Y'),
                ];
            })->toArray(),
            'today' => now()->format('F d, Y'),
        ];

        // Render HTML certificate view
        return view('training_officer.certificate', $data);

        // Optional: Generate PDF from HTML
        /*
        $pdf = Pdf::loadView('training_officer.certificate', $data);
        return $pdf->download('certificate_' . $prisoner->id . '_' . now()->format('Ymd') . '.pdf');
        */
    }
    public function dashboard()
    {
        return view('training_officer.dashboard');
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
            'end_date' => 'required|date',
            'status' => 'required|in:active,completed,terminated',
            'job_description' => 'nullable|string',
        ]);

        // Create the job assignment record
        JobAssignment::create([
            'prisoner_id' => $validated['prisoner_id'],
            'assigned_by' => session('user_id'),
            'job_title' => $validated['job_title'],
            'assigned_date' => $validated['assigned_date'],
            'end_date' => $validated['end_date'],
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

        return view('training_officer.assignTrainingPrograms', compact('prisoners', 'programs', 'assignments'));
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
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',

        ]);

        // Add prison_id from session
        $data['prison_id'] = session('prison_id');
        $data['created_by'] = session('user_id');

        // Disable auditing for this operation
        $trainingProgram = TrainingProgram::withoutAuditing(function () use ($data) {
            return TrainingProgram::create($data);
        });

        return redirect()->back()->with('success', 'Training program created successfully.');
    }


    public function assignTrainingProgram(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'prisoner_id' => 'required|exists:prisoners,id',
            'training_id' => 'required|exists:training_programs,id',
            'assigned_date' => 'required|date',
            'end_date' => 'required|date',
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


    public function updateAssign(Request $request, $id)
    {
        $validated = $request->validate([
            'prisoner_id' => 'required|string|max:255',
            'training_id' => 'required|integer|exists:training_programs,id',
            'assigned_by' => 'required|string|max:255',
            'assigned_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:assigned_date',
            'status' => 'required|in:in_progress,completed,unassigned',
        ]);
    
        Log::info('Validated data for assignment update', [
            'assignment_id' => $id,
            'data' => $validated,
            'user_id' => session('user_id'), // if authentication is used
        ]);
    
        $assignment = TrainingAssignment::findOrFail($id);
        $assignment->update($validated);
    
        Log::info('Assignment updated successfully', [
            'assignment_id' => $id,
            'updated_by' => session('user_id'), // optional
        ]);
    
        return redirect()->back()->with('success', 'Assignment updated successfully');
    }
    
    // View list of training programs
    public function viewTrainingPrograms()
    {
        $trainingprograms = TrainingProgram::paginate(9);
        $activities = Audit::with('user')->latest()->take(20)->get();

        return view('training_officer.viewTrainingPrograms', compact('trainingprograms', 'activities'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'prisoner_id' => 'required|string|max:255',
            'assigned_by' => 'required|string|max:255',
            'job_description' => 'required|string',
            'assigned_date' => 'required|date',
            'status' => 'required|in:active,completed,terminated',
        ]);

        $job = JobAssignment::findOrFail($id);
        $job->update($validated);

        return redirect()->back()->with('success', 'Job updated successfully');
    }
    public function destroy($id)
    {
        $program = TrainingProgram::findOrFail($id);
        $program->delete();

        return redirect()->back()->with('success', 'Training program deleted successfully.');
    }

    public function destroyjob(JobAssignment $job) // Type-hint the Job model
    {
        $job->delete();
        return redirect()->back()->with('success', 'Job deleted successfully');
    }
}
