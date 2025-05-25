<?php

namespace App\Http\Controllers\training_officer;

use App\Http\Controllers\Controller;
use App\Models\CertificationRecord;
use App\Models\TrainingProgram;
use App\Models\Prisoner;
use App\Models\TrainingAssignment;
use App\Models\JobAssignment;
use App\Models\Account;
use App\Models\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\Log;

class TrainingController extends Controller
{
    // Helper method to create prisoner-related notifications
    private function createNotification($recipientId, $recipientRole, $roleId, $relatedTable, $relatedId, $title, $message, $prisonId)
    {
        Notification::create([
            'recipient_id' => $recipientId,
            'recipient_role' => $recipientRole,
            'role_id' => $roleId,
            'related_table' => $relatedTable,
            'related_id' => $relatedId,
            'title' => $title,
            'message' => $message,
            'is_read' => false,
            'prison_id' => $prisonId,
        ]);
    }
    
    // Escape special characters for HTML
    protected function escapeHtml($string)
    {
        return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
    }

    public function dashboard()
    {
        $prisonId = session('prison_id');

        if (!$prisonId) {
            Log::warning('No prison_id in session for dashboard');
            return redirect()->route('home')->with('error', 'Prison ID not set.');
        }

        try {
            $totalPrisoners = Prisoner::where('prison_id', $prisonId)->count();
            $totalCertifications = CertificationRecord::whereHas('prisoner', function ($query) use ($prisonId) {
                $query->where('prison_id', $prisonId);
            })->count();
            $totalActiveJobs = JobAssignment::whereHas('prisoner', function ($query) use ($prisonId) {
                $query->where('prison_id', $prisonId);
            })->where('status', 'active')->count();
            $recentCertifications = CertificationRecord::whereHas('prisoner', function ($query) use ($prisonId) {
                $query->where('prison_id', $prisonId);
            })
                ->with(['prisoner', 'issuedBy'])
                ->orderBy('issued_date', 'desc')
                ->take(5)
                ->get();

            Log::info('Dashboard data fetched', [
                'prison_id' => $prisonId,
                'total_prisoners' => $totalPrisoners,
                'total_certifications' => $totalCertifications,
                'total_active_jobs' => $totalActiveJobs,
                'recent_certifications_count' => $recentCertifications->count(),
            ]);

            return view('training_officer.dashboard', compact(
                'totalPrisoners',
                'totalCertifications',
                'totalActiveJobs',
                'recentCertifications'
            ));
        } catch (\Exception $e) {
            Log::error('Error fetching dashboard data', ['error' => $e->getMessage(), 'prison_id' => $prisonId]);
            return redirect()->route('home')->with('error', 'Failed to load dashboard.');
        }
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
        $trainingOfficerId = session('user_id');
        $roleId = session('role_id');
    
        $prisoner = Prisoner::where('id', $validated['prisoner_id'])
            ->where('prison_id', $prisonId)
            ->with([
                'jobAssignments' => fn($q) => $q->where('status', 'completed')
                    ->select('id', 'prisoner_id', 'job_title', 'job_description', 'end_date'),
                'trainingAssignments' => fn($q) => $q->where('status', 'completed')
                    ->select('id', 'prisoner_id', 'training_id', 'end_date'),
                'trainingAssignments.trainingProgram' => fn($q) => $q->select('id', 'title'),
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
    
        // Notify the prisoner
        $this->createNotification(
            $prisoner->id,
            'prisoner',
            null, // Prisoners don't have a role ID
            'certification_records',
            $certification->id,
            'Certification Issued',
            "prisoner {$prisoner->first_name} {$prisoner->last_name} been issued a {$validated['certification_type']} certification.",
            $prisonId
        );
    
        // Notify the training officer
        if ($trainingOfficerId && $roleId) {
            $this->createNotification(
                $trainingOfficerId,
                'officer',
                $roleId,
                'certification_records',
                $certification->id,
                'Certification Assigned',
                "You assigned a {$validated['certification_type']} certification to {$prisonerName}.",
                $prisonId
            );
        }
    
        $data = [
            'prisoner_name' => $this->escapeHtml($prisonerName),
            'certification_type' => $validated['certification_type'] === 'job_completion' 
                ? 'Job Completion' 
                : 'Training Program Completion',
            'certification_details' => $this->escapeHtml($validated['certification_details'] ?? 'No additional details provided.'),
            'issued_by' => $this->escapeHtml(trim(session('first_name') . ' ' . session('last_name'))),
            'issued_date' => \Carbon\Carbon::parse($certification->issued_date)->format('F d, Y'),
            'completed_jobs' => $prisoner->jobAssignments->map(fn($job) => [
                'job_title' => $this->escapeHtml($job->job_title),
                'completed_date' => $job->end_date->format('M d, Y'),
            ])->toArray(),
            'completed_trainings' => $prisoner->trainingAssignments->map(fn($training) => [
                'training_title' => $this->escapeHtml(optional($training->trainingProgram)->title ?? 'Unknown Training'),
                'completed_date' => $training->end_date->format('M d, Y'),
            ])->toArray(),
            'today' => now()->format('F d, Y'),
        ];
    
        return view('training_officer.certificate', $data);
    }
    

    public function viewCertificate($id)
    {
        $prisonId = session('prison_id');

        if (!$prisonId) {
            Log::warning('No prison_id in session for viewCertificate');
            return redirect()->route('home')->with('error', 'Prison ID not set.');
        }

        try {
            $certification = CertificationRecord::where('id', $id)
                ->whereHas('prisoner', function ($query) use ($prisonId) {
                    $query->where('prison_id', $prisonId);
                })
                ->with([
                    'prisoner.jobAssignments' => function ($query) {
                        $query->where('status', 'completed')
                            ->select('id', 'prisoner_id', 'job_title', 'job_description', 'end_date');
                    },
                    'prisoner.trainingAssignments' => function ($query) {
                        $query->where('status', 'completed')
                            ->select('id', 'prisoner_id', 'training_id', 'end_date');
                    },
                    'prisoner.trainingAssignments.trainingProgram' => function ($query) {
                        $query->select('id', 'title');
                    },
                    'issuedBy'
                ])
                ->firstOrFail();

            $prisonerName = trim(implode(' ', array_filter([
                $certification->prisoner->first_name,
                $certification->prisoner->middle_name,
                $certification->prisoner->last_name
            ])));

            $data = [
                'prisoner_name' => $this->escapeHtml($prisonerName),
                'certification_type' => $certification->certification_type === 'job_completion' ? 'Job Completion' : 'Training Program Completion',
                'certification_details' => $this->escapeHtml($certification->certification_details ?? 'No additional details provided.'),
                'issued_by' => $this->escapeHtml(trim($certification->issuedBy->first_name . ' ' . $certification->issuedBy->last_name)),
                'issued_date' => \Carbon\Carbon::parse($certification->issued_date)->format('F d, Y'),
                'completed_jobs' => $certification->prisoner->jobAssignments->map(function ($job) {
                    return [
                        'job_title' => $this->escapeHtml($job->job_title),
                        'completed_date' => $job->end_date->format('M d, Y'),
                    ];
                })->toArray(),
                'completed_trainings' => $certification->prisoner->trainingAssignments->map(function ($training) {
                    return [
                        'training_title' => $this->escapeHtml(optional($training->trainingProgram)->title ?? 'Unknown Training'),
                        'completed_date' => $training->end_date->format('M d, Y'),
                    ];
                })->toArray(),
                'today' => now()->format('F d, Y'),
            ];

            return view('training_officer.certificate', $data);
        } catch (\Exception $e) {
            Log::error('Error viewing certificate', ['id' => $id, 'error' => $e->getMessage()]);
            return redirect()->route('training_officer.viewCertifications')->with('error', 'Certificate not found.');
        }
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

    public function assignJobs()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->get();
        return view('training_officer.assignJobs', compact('prisoners'));
    }

    public function assignJob(Request $request)
    {
        $validated = $request->validate([
            'prisoner_id' => 'required|exists:prisoners,id',
            'job_title' => 'required|string|max:100',
            'assigned_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:active,completed,terminated',
            'job_description' => 'nullable|string',
        ]);
    
        $prisonId = session('prison_id');
        $trainingOfficerId = session('user_id');
        $roleId = session('role_id');
    
        $jobAssignment = JobAssignment::create([
            'prisoner_id' => $validated['prisoner_id'],
            'assigned_by' => $trainingOfficerId,
            'job_title' => $validated['job_title'],
            'assigned_date' => $validated['assigned_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
            'job_description' => $validated['job_description'] ?? null,
        ]);
    
        $prisoner = Prisoner::find($validated['prisoner_id']);
        $prisonerName = trim(implode(' ', array_filter([
            $prisoner->first_name,
            $prisoner->middle_name,
            $prisoner->last_name
        ])));
    
        // Notify prisoner
        $this->createNotification(
            $prisoner->id,
            'prisoner',
            null, // Prisoners may not have a role_id
            'job_assignments',
            $jobAssignment->id,
            'Job Assigned',
            "prisoner {$prisoner->first_name} {$prisoner->last_name} have been assigned the job: {$validated['job_title']}.",
            $prisonId
        );
    
        // Notify training officer
        if ($trainingOfficerId && $roleId) {
            $this->createNotification(
                $trainingOfficerId,
                'officer',
                $roleId,
                'job_assignments',
                $jobAssignment->id,
                'Job Assigned',
                "You assigned the job {$validated['job_title']} to {$prisonerName}.",
                $prisonId
            );
        }
    
        Log::info('Job assigned successfully', [
            'job_id' => $jobAssignment->id,
            'prisoner_id' => $validated['prisoner_id'],
            'job_title' => $validated['job_title']
        ]);
    
        return redirect()->back()->with('success', 'Job assigned successfully.');
    }
    

    public function storeJobs(Request $request)
    {
        $validated = $request->validate([
            'prisoner_id' => 'required|exists:prisoners,id',
            'job_title' => 'required|string|max:100',
            'assigned_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:active,completed,terminated',
            'job_description' => 'nullable|string',
        ]);

        $jobAssignment = JobAssignment::create([
            'prisoner_id' => $validated['prisoner_id'],
            'assigned_by' => session('user_id'),
            'job_title' => $validated['job_title'],
            'assigned_date' => $validated['assigned_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
            'job_description' => $validated['job_description'] ?? null,
        ]);

        $prisoner = Prisoner::find($validated['prisoner_id']);
        $prisonerName = trim(implode(' ', array_filter([
            $prisoner->first_name,
            $prisoner->middle_name,
            $prisoner->last_name
        ])));

      

        Log::info('Job assigned successfully via storeJobs', [
            'job_id' => $jobAssignment->id,
            'prisoner_id' => $validated['prisoner_id'],
            'job_title' => $validated['job_title']
        ]);

        return redirect()->route('training_officer.viewJobs')->with('success', 'Jobs assigned successfully');
    }

    public function createTrainingPrograms()
    {
        return view('training_officer.createTrainingPrograms');
    }

    public function storeTrainingProgram(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $data['prison_id'] = session('prison_id');
        $data['created_by'] = session('user_id');

        $trainingProgram = TrainingProgram::withoutAuditing(function () use ($data) {
            return TrainingProgram::create($data);
        });

        Log::info('Training program created successfully', [
            'program_id' => $trainingProgram->id,
            'title' => $data['title']
        ]);

        return redirect()->back()->with('success', 'Training program created successfully.');
    }

    public function assignTrainingPrograms()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))
            ->whereDoesntHave('trainingAssignments')
            ->get();
        $programs = TrainingProgram::where('prison_id', session('prison_id'))->get();
        $assignments = TrainingAssignment::with('trainingProgram')->whereHas('prisoner', function ($query) {
            $query->where('prison_id', session('prison_id'));
        })->get();

        return view('training_officer.assignTrainingPrograms', compact('prisoners', 'programs', 'assignments'));
    }

    public function assignTrainingProgram(Request $request)
    {
        $data = $request->validate([
            'prisoner_id' => 'required|exists:prisoners,id',
            'training_id' => 'required|exists:training_programs,id',
            'assigned_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:in_progress,completed',
        ]);
    
        $data['assigned_by'] = session('user_id');
        $prisonId = session('prison_id');
        $roleId = session('role_id');
        $trainingOfficerId = session('user_id');
    
        $trainingAssignment = TrainingAssignment::create($data);
    
        $prisoner = Prisoner::find($data['prisoner_id']);
        $trainingProgram = TrainingProgram::find($data['training_id']);
    
        $prisonerName = trim(implode(' ', array_filter([
            $prisoner->first_name,
            $prisoner->middle_name,
            $prisoner->last_name
        ])));
    
        // Notify prisoner
        $this->createNotification(
            $prisoner->id,
            'prisoner',
            null, // Prisoners typically don't have a role ID
            'training_assignments',
            $trainingAssignment->id,
            'Training Program Assigned',
            "prisoner {$prisoner->first_name} {$prisoner->last_name}  have been assigned to the training program: {$trainingProgram->title}.",
            $prisonId
        );
    
        // Notify training officer
        if ($trainingOfficerId && $roleId) {
            $this->createNotification(
                $trainingOfficerId,
                'officer',
                $roleId,
                'training_assignments',
                $trainingAssignment->id,
                'Training Program Assigned',
                "You assigned the training program {$trainingProgram->title} to {$prisonerName}.",
                $prisonId
            );
        }
    
        Log::info('Training program assigned successfully', [
            'assignment_id' => $trainingAssignment->id,
            'prisoner_id' => $data['prisoner_id'],
            'training_id' => $data['training_id']
        ]);
    
        return redirect()->back()->with('success', 'Training program assigned successfully.');
    }
    
    public function viewAssignedPrograms()
    {
        $assignments = TrainingAssignment::whereHas('prisoner', function ($query) {
            $query->where('prison_id', session('prison_id'));
        })->with(['prisoner', 'trainingProgram'])->get();

        return view('training_officer.viewAssignedPrograms', compact('assignments'));
    }

    public function unassignTrainingProgram($id)
    {
        $assignment = TrainingAssignment::findOrFail($id);
        $prisoner = Prisoner::find($assignment->prisoner_id);
        $trainingProgram = TrainingProgram::find($assignment->training_id);
    
        $prisonerName = $prisoner ? trim(implode(' ', array_filter([
            $prisoner->first_name,
            $prisoner->middle_name,
            $prisoner->last_name
        ]))) : 'Unknown';
    
        $assignment->update([
            'prisoner_id' => null,
            'training_id' => null,
            'status' => null,
        ]);
    
        $prisonId = session('prison_id');
        $roleId = session('role_id');
        $trainingOfficerId = session('user_id');
    
        // Notify prisoner
        if ($prisoner) {
            $this->createNotification(
                $prisoner->id,
                'prisoner',
                null,
                'training_assignments',
                $id,
                'Training Program Unassigned',
                "prisoner {$prisoner->first_name} {$prisoner->last_name}  have been unassigned from the training program: {$trainingProgram->title}.",
                $prisonId
            );
        }
    
        // Notify training officer
        if ($trainingOfficerId && $roleId) {
            $this->createNotification(
                $trainingOfficerId,
                'officer',
                $roleId,
                'training_assignments',
                $id,
                'Training Program Unassigned',
                "You unassigned {$prisonerName} from the training program {$trainingProgram->title}.",
                $prisonId
            );
        }
    
        Log::info('Training program unassigned successfully', ['assignment_id' => $id]);
    
        return redirect()->back()->with('success', 'Training program unassigned successfully.');
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
    
        $prisoner = Prisoner::find($validated['prisoner_id']);
        $prisonerName = trim(implode(' ', array_filter([
            $prisoner->first_name,
            $prisoner->middle_name,
            $prisoner->last_name
        ])));
    
        $roleId = session('role_id');
        $prisonId = session('prison_id');
        $trainingOfficerId = session('user_id');
    
        // Notify prisoner
        if ($prisoner) {
            $this->createNotification(
                $prisoner->id,
                'prisoner',
                null,
                'job_assignments',
                $job->id,
                'Job Updated',
                "prisoner {$prisoner->first_name} {$prisoner->last_name}  job assignment ({$validated['job_title']}) has been updated.",
                $prisonId
            );
        }
    
        // Notify training officer
        if ($trainingOfficerId && $roleId) {
            $this->createNotification(
                $trainingOfficerId,
                'officer',
                $roleId,
                'job_assignments',
                $job->id,
                'Job Updated',
                "You updated the job {$validated['job_title']} for {$prisonerName}.",
                $prisonId
            );
        }
    
        Log::info('Job updated successfully', [
            'job_id' => $job->id,
            'prisoner_id' => $validated['prisoner_id'],
            'job_title' => $validated['job_title']
        ]);
    
        return redirect()->back()->with('success', 'Job updated successfully.');
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
    $prisoner = Prisoner::find($validated['prisoner_id']);
    $prisonerName = $prisoner ? trim(implode(' ', array_filter([
        $prisoner->first_name,
        $prisoner->middle_name,
        $prisoner->last_name
    ]))) : 'Unknown';

    $job->update($validated);

    $trainingOfficerId = session('user_id');
    $roleId = session('role_id');
    $prisonId = session('prison_id');

    // Notify prisoner
    if ($prisoner) {
        $this->createNotification(
            $prisoner->id,
            'prisoner',
            null,
            'job_assignments',
            $job->id,
            'Job Updated',
            "prisoner {$prisoner->first_name} {$prisoner->last_name}  job assignment ({$validated['job_title']}) has been updated.",
            $prisonId
        );
    }

    // Notify training officer
    if ($trainingOfficerId && $roleId) {
        $this->createNotification(
            $trainingOfficerId,
            'officer',
            $roleId,
            'job_assignments',
            $job->id,
            'Job Updated',
            "You updated the job {$validated['job_title']} for {$prisonerName}.",
            $prisonId
        );
    }

    Log::info('Job updated successfully via update', [
        'job_id' => $job->id,
        'prisoner_id' => $validated['prisoner_id'],
        'job_title' => $validated['job_title']
    ]);

    return redirect()->back()->with('success', 'Job updated successfully');
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

    $assignment = TrainingAssignment::findOrFail($id);
    $prisoner = Prisoner::find($validated['prisoner_id']);
    $trainingProgram = TrainingProgram::find($validated['training_id']);
    $prisonerName = $prisoner ? trim(implode(' ', array_filter([
        $prisoner->first_name,
        $prisoner->middle_name,
        $prisoner->last_name
    ]))) : 'Unknown';

    $assignment->update($validated);

    $trainingOfficerId = session('user_id');
    $roleId = session('role_id');
    $prisonId = session('prison_id');

    // Notify prisoner
    if ($prisoner) {
        $this->createNotification(
            $prisoner->id,
            'prisoner',
            null,
            'training_assignments',
            $assignment->id,
            'Training Assignment Updated',
            "prisoner {$prisoner->first_name} {$prisoner->last_name}  assignment to the training program {$trainingProgram->title} has been updated.",
            $prisonId
        );
    }

    // Notify officer
    if ($trainingOfficerId && $roleId) {
        $this->createNotification(
            $trainingOfficerId,
            'officer',
            $roleId,
            'training_assignments',
            $assignment->id,
            'Training Assignment Updated',
            "You updated the assignment of {$prisonerName} to the training program {$trainingProgram->title}.",
            $prisonId
        );
    }

    Log::info('Training assignment updated successfully', [
        'assignment_id' => $id,
        'prisoner_id' => $validated['prisoner_id'],
        'training_id' => $validated['training_id']
    ]);

    return redirect()->back()->with('success', 'Assignment updated successfully');
}

    public function viewCertifications()
    {
        return view('training_officer.viewCertifications');
    }

    public function viewCertificationss(Request $request)
    {
        $prisonId = session('prison_id');

        if (!$prisonId) {
            Log::warning('No prison_id in session for viewCertifications');
            return redirect()->route('home')->with('error', 'Prison ID not set.');
        }

        $search = $request->query('search');
        $certifications = collect();

        try {
            $certifications = CertificationRecord::whereHas('prisoner', function ($query) use ($prisonId) {
                $query->where('prison_id', $prisonId);
            })
            ->with(['prisoner', 'issuedBy'])
            ->when($search, function ($query, $search) {
                $query->whereHas('prisoner', function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                      ->orWhere('middle_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%");
                })
                ->orWhere('certification_type', 'like', "%{$search}%")
                ->orWhereHas('issuedBy', function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%");
                });
            })
            ->get();

            Log::info('Certifications fetched', ['count' => $certifications->count(), 'prison_id' => $prisonId, 'search' => $search]);
        } catch (\Exception $e) {
            Log::error('Error fetching certifications', ['error' => $e->getMessage(), 'prison_id' => $prisonId]);
            return redirect()->route('home')->with('error', 'Failed to load certifications.');
        }

        return view('training_officer.viewCertifications', compact('certifications'));
    }

    public function viewJobs()
    {
        $jobs = JobAssignment::whereHas('prisoner', function ($query) {
            $query->where('prison_id', session('prison_id'));
        })->paginate(9);

        return view('training_officer.viewJobs', compact('jobs'));
    }

    public function viewTrainingPrograms()
    {
        $trainingprograms = TrainingProgram::where('prison_id', session('prison_id'))->paginate(9);
        $activities = Audit::with('user')->latest()->take(20)->get();

        return view('training_officer.viewTrainingPrograms', compact('trainingprograms', 'activities'));
    }

    public function destroy($id)
    {
        $program = TrainingProgram::findOrFail($id);

        

        $program->delete();

        Log::info('Training program deleted successfully', ['program_id' => $id]);

        return redirect()->back()->with('success', 'Training program deleted successfully.');
    }

    public function destroyjob(JobAssignment $job)
    {
        $prisoner = Prisoner::find($job->prisoner_id);
      

        $job->delete();

        Log::info('Job deleted successfully', ['job_id' => $job->id]);

        return redirect()->back()->with('success', 'Job deleted successfully');
    }

    // View prisoner-related notifications
    public function viewNotifications(Request $request)
    {
        $user = $request->user();
        $role = $user->role_id == 1 ? 'admin' :
                ($user->role_id == 3 ? 'officer' : 'prisoner');

        $notifications = Notification::where('recipient_id', $user->user_id)
            ->where('recipient_role', $role)
            ->whereIn('related_table', ['certification_records', 'job_assignments', 'training_assignments', 'training_programs'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json($notifications);
        }

        return view('training_officer.notifications', compact('notifications'));
    }

    // Mark a notification as read
    public function markAsRead(Request $request, $notification_id)
    {
        $notification = Notification::where('recipient_id', $request->user()->user_id)
            ->whereIn('related_table', ['certification_records', 'job_assignments', 'training_assignments', 'training_programs'])
            ->findOrFail($notification_id);
        $notification->is_read = true;
        $notification->save();

        return response()->json(['message' => 'Notification marked as read']);
    }

    // Mark all notifications as read
    public function markAllAsRead(Request $request)
    {
        $user = $request->user();
        $role = $user->role_id == 1 ? 'admin' :
                ($user->role_id == 3 ? 'officer' : 'prisoner');

        Notification::where('recipient_id', $user->user_id)
            ->where('recipient_role', $role)
            ->whereIn('related_table', ['certification_records', 'job_assignments', 'training_assignments', 'training_programs'])
            ->update(['is_read' => true]);

        return response()->json(['message' => 'All notifications marked as read']);
    }
}