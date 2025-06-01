<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Prison;
use App\Models\MedicalAppointment;
use App\Models\LawyerAppointment;
use App\Models\JobAssignment;
use App\Models\TrainingProgram;
use App\Models\Prisoner;
use App\Models\LawyerPrisonerAssignment;
use App\Models\PolicePrisonerAssignment;
use App\Models\Lawyer;
use App\Models\MedicalReport;
use App\Models\Notification;
use App\Models\Requests;
use Carbon\Carbon;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class iPrisonerController extends Controller
{
    public function updatepr(Request $request, $id) {
        Log::info("Update prisoner request started.", ['prisoner_id' => $id, 'user_id' => session('user_id')]);
    
        $prisoner = Prisoner::findOrFail($id);
    
        // Handle custom crime
        $crime_committed = $request->crime_committed === 'Other' ? $request->other_crime : $request->crime_committed;
    
        // Prepare data to update
        $updateData = [
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'dob' => $request->dob,
            'sex' => $request->sex,
            'address' => $request->address,
            'marital_status' => $request->marital_status,
            'crime_committed' => $crime_committed,
            'status' => $request->status,
            'time_serve_start' => $request->time_serve_start,
            'time_serve_end' => $request->time_serve_end,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_relation' => $request->emergency_contact_relation,
            'emergency_contact_number' => $request->emergency_contact_number,
            'prison_id' => $request->prison_id,
        ];
    
        // Handle image upload
        if ($request->hasFile('inmate_image')) {
            if ($prisoner->inmate_image) {
                Storage::delete($prisoner->inmate_image);
                Log::info("Old inmate image deleted.", ['prisoner_id' => $id]);
            }
            $updateData['inmate_image'] = $request->file('inmate_image')->store('inmate_images', 'public');
            Log::info("New inmate image uploaded.", ['prisoner_id' => $id, 'image_path' => $updateData['inmate_image']]);
        }
    
        $prisoner->update($updateData);
    
        Log::info("Prisoner updated successfully.", ['prisoner_id' => $id, 'updated_data' => $updateData]);
    
        return redirect()->back()->with('success', 'Prisoner updated successfully.');
    }
    public function toggleStatus(Request $request, $id)
{
    $prisoner = Prisoner::findOrFail($id);

    if ($prisoner->status === 'Active') {
        // Deactivate prisoner
        $prisoner->status = 'Inactive';
    } else {
        // Reactivate prisoner — validate input
        $request->validate([
            'time_serve_end' => 'required|string|max:255'
        ]);

        $endDate = strtolower($request->time_serve_end);

        // If sentence is numeric date, validate it as a future date
        if (!in_array($endDate, ['life sentence', 'death'])) {
            // Validate date format
            $request->validate([
                'time_serve_end' => 'date|after:today'
            ]);
        }

        // Reactivate and set end date (supports 'Life Sentence', 'Death', or a valid date)
        $prisoner->status = 'Active';
        $prisoner->time_serve_end = $request->time_serve_end;
    }

    $prisoner->save();

    return redirect()->back()->with('success', 'Prisoner status updated.');
}


    public function changePassword(Request $request, $lawyer_id)
{
   
    $lawyer = Lawyer::findOrFail($lawyer_id);
    $lawyer->password = Hash::make($request->new_password);
    $lawyer->save();

    return response()->json(['message' => 'Password updated successfully'], 200);
}
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

    public function index()
    {
        return view('inspector.add_prisoner');
    }

    public function policeofficer()
    {
        $prisonId = session('prison_id');
        $roleId = 8; 

        $officers = Account::where('prison_id', $prisonId)
            ->where('role_id', $roleId)
            ->get();


        $prisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);
        $lawyer = Lawyer::where('prison', session('prison_id'))->paginate(9);
        $assignments = PolicePrisonerAssignment::where('prison_id', session('prison_id'))->paginate(9);
        return view('inspector.assign_policeofficer', compact('officers', 'prisoners', 'assignments'));
    }

    public function idashboard()
    {
        try {
            $prisonId = session('prison_id');

            // Dashboard Cards
            $activePrisoners = Prisoner::where('prison_id', $prisonId)
                ->where('status', 'Active')
                ->count();

            $lawyerAssignmentsThisWeek = LawyerPrisonerAssignment::where('prison_id', $prisonId)
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->count();

            $policeAssignmentsThisWeek = PolicePrisonerAssignment::where('prison_id', $prisonId)
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->count();

            $newPrisonersThisWeek = Prisoner::where('prison_id', $prisonId)
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->count();

            $lawyerProfiles = Lawyer::where('prison', $prisonId)->count();

            $newLawyerProfiles = Lawyer::where('prison', $prisonId)
                ->where('created_at', '>=', now()->subDays(30))
                ->count();

            $policeAssignments = PolicePrisonerAssignment::where('prison_id', $prisonId)
                ->where('assignment_date', '>=', now()->subDays(30))
                ->count();

            $policeAssignmentsInProgress = PolicePrisonerAssignment::where('prison_id', $prisonId)
                ->where('assignment_date', '>=', now()->subDays(7))
                ->count();

            $pendingAssignmentsAlert = $lawyerAssignmentsThisWeek + $policeAssignmentsThisWeek;

            $days = collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('D'))->toArray();

            $fullyAssignedData = collect(range(6, 0))->map(function ($i) use ($prisonId) {
                $date = now()->subDays($i)->startOfDay();
                return Prisoner::where('prison_id', $prisonId)
                    ->where('status', 'Active')
                    ->whereExists(function ($query) use ($date) {
                        $query->select(DB::raw(1))
                            ->from('lawyer_prisoner_assignment')
                            ->whereColumn('lawyer_prisoner_assignment.prisoner_id', 'prisoners.id')
                            ->where('prison_id', DB::raw(session('prison_id')))
                            ->whereDate('created_at', '<=', $date);
                    })
                    ->whereExists(function ($query) use ($date) {
                        $query->select(DB::raw(1))
                            ->from('police_prisoner_assignment')
                            ->whereColumn('police_prisoner_assignment.prisoner_id', 'prisoners.id')
                            ->where('prison_id', DB::raw(session('prison_id')))
                            ->whereDate('created_at', '<=', $date);
                    })
                    ->count();
            })->toArray();

            $notFullyAssignedData = collect(range(6, 0))->map(function ($i) use ($prisonId) {
                $date = now()->subDays($i)->startOfDay();
                return Prisoner::where('prison_id', $prisonId)
                    ->where('status', 'Active')
                    ->where(function ($query) use ($date) {
                        $query->whereNotExists(function ($subQuery) use ($date) {
                            $subQuery->select(DB::raw(1))
                                ->from('lawyer_prisoner_assignment')
                                ->whereColumn('lawyer_prisoner_assignment.prisoner_id', 'prisoners.id')
                                ->where('prison_id', DB::raw(session('prison_id')))
                                ->whereDate('created_at', '<=', $date);
                        })
                            ->orWhereNotExists(function ($subQuery) use ($date) {
                                $subQuery->select(DB::raw(1))
                                    ->from('police_prisoner_assignment')
                                    ->whereColumn('police_prisoner_assignment.prisoner_id', 'prisoners.id')
                                    ->where('prison_id', DB::raw(session('prison_id')))
                                    ->whereDate('created_at', '<=', $date);
                            });
                    })
                    ->count();
            })->toArray();

            $assignmentChartData = [
                'labels' => $days,
                'fullyAssigned' => $fullyAssignedData,
                'notFullyAssigned' => $notFullyAssignedData,
            ];

            $fullyAssigned = Prisoner::where('prison_id', $prisonId)
                ->where('status', 'Active')
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('lawyer_prisoner_assignment')
                        ->whereColumn('lawyer_prisoner_assignment.prisoner_id', 'prisoners.id')
                        ->where('prison_id', DB::raw(session('prison_id')));
                })
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('police_prisoner_assignment')
                        ->whereColumn('police_prisoner_assignment.prisoner_id', 'prisoners.id')
                        ->where('prison_id', DB::raw(session('prison_id')));
                })
                ->count();

            $partiallyAssigned = Prisoner::where('prison_id', $prisonId)
                ->where('status', 'Active')
                ->where(function ($query) {
                    $query->whereExists(function ($subQuery) {
                        $subQuery->select(DB::raw(1))
                            ->from('lawyer_prisoner_assignment')
                            ->whereColumn('lawyer_prisoner_assignment.prisoner_id', 'prisoners.id')
                            ->where('prison_id', DB::raw(session('prison_id')));
                    })->orWhereExists(function ($subQuery) {
                        $subQuery->select(DB::raw(1))
                            ->from('police_prisoner_assignment')
                            ->whereColumn('police_prisoner_assignment.prisoner_id', 'prisoners.id')
                            ->where('prison_id', DB::raw(session('prison_id')));
                    });
                })
                ->where(function ($query) {
                    $query->whereNotExists(function ($subQuery) {
                        $subQuery->select(DB::raw(1))
                            ->from('lawyer_prisoner_assignment')
                            ->whereColumn('lawyer_prisoner_assignment.prisoner_id', 'prisoners.id')
                            ->where('prison_id', DB::raw(session('prison_id')));
                    })
                        ->orWhereNotExists(function ($subQuery) {
                            $subQuery->select(DB::raw(1))
                                ->from('police_prisoner_assignment')
                                ->whereColumn('police_prisoner_assignment.prisoner_id', 'prisoners.id')
                                ->where('prison_id', DB::raw(session('prison_id')));
                        });
                })
                ->count();

            $notAssigned = Prisoner::where('prison_id', $prisonId)
                ->where('status', 'Active')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('lawyer_prisoner_assignment')
                        ->whereColumn('lawyer_prisoner_assignment.prisoner_id', 'prisoners.id')
                        ->where('prison_id', DB::raw(session('prison_id')));
                })
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('police_prisoner_assignment')
                        ->whereColumn('police_prisoner_assignment.prisoner_id', 'prisoners.id')
                        ->where('prison_id', DB::raw(session('prison_id')));
                })
                ->count();

            $assignmentStatusData = [
                'fullyAssigned' => $fullyAssigned,
                'partiallyAssigned' => $partiallyAssigned,
                'notAssigned' => $notAssigned,
            ];

            Log::info('Inspector dashboard loaded successfully', ['prison_id' => $prisonId]);

            return view('inspector.dashboard', compact(
                'activePrisoners',
                'lawyerAssignmentsThisWeek',
                'policeAssignmentsThisWeek',
                'newPrisonersThisWeek',
                'lawyerProfiles',
                'newLawyerProfiles',
                'policeAssignments',
                'policeAssignmentsInProgress',
                'pendingAssignmentsAlert',
                'assignmentChartData',
                'assignmentStatusData'
            ));
        } catch (\Exception $e) {
            Log::error('Failed to load inspector dashboard data', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return redirect()->back()->with('error', 'Failed to load dashboard data.');
        }
    }

    public function lawyer()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))
            ->whereDoesntHave('assignedLawyers')
            ->get();

        return view('inspector.add_lawyer', compact('prisoners'));
    }

    public function asslawyer()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);
        $lawyer = Lawyer::where('prison', session('prison_id'))->paginate(9);
        $assignments = LawyerPrisonerAssignment::where('prison_id', session('prison_id'))->paginate(9);

        return view('inspector.assign_lawyer', compact('assignments', 'prisoners', 'lawyer'));
    }

    public function updateStatusrequest(Request $request, $id)
    {
        $requeststatus = Prisoner::where('prison_id', session('prison_id'))
            ->find($request->id);

        if ($requeststatus) {
            $requeststatus->status = $request->room_id;
            $requeststatus->save();
            return back()->with('success', 'Room allocated successfully!');
        }

        return back()->with('error', 'Prisoner not found!');
    }

    public function allocate()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))
            ->whereNull('room_id')
            ->paginate(9);

        $rooms = Room::where('prison_id', session('prison_id'))->paginate(9);
        return view('police_officer.allocate_room', compact('prisoners', 'rooms'));
    }

    public function roomassign()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);
        $rooms = Room::where('prison_id', session('prison_id'))->paginate(9);
        return view('police_officer.view _allocation', compact('prisoners', 'rooms'));
    }

    public function allocateRoom(Request $request)
{
    $prisoner = Prisoner::where('prison_id', session('prison_id'))->find($request->id);

    if (!$prisoner) {
        return back()->with('error', 'Prisoner not found!');
    }

    // Get the room, filter by ID, prison ID, and status
    $room = Room::where('id', $request->room_id)
                ->where('prison_id', session('prison_id'))
                ->where('status', 'available') // Or 'Open', based on your convention
                ->first();

    if (!$room) {
        return back()->with('error', 'Room not found or not available!');
    }

    // Count how many prisoners are currently assigned to the room
    $currentOccupancy = Prisoner::where('room_id', $room->id)->count();

    // Check capacity
    if ($currentOccupancy >= $room->capacity) {
        return back()->with('error', 'Room is already at full capacity!');
    }

    // Assign room to prisoner
    $prisoner->room_id = $room->id;
    $prisoner->save();

    // Notify the prisoner
    $this->createNotification(
        $prisoner->id,
        'prisoner',
        null,
        'prisoners',
        $prisoner->id,
        'Room Allocation',
        "Prisoner {$prisoner->first_name} {$prisoner->last_name} has been allocated to room {$room->room_number}.",
        $prisoner->prison_id
    );

    return back()->with('success', 'Room allocated successfully!');
}

    public function assignlawyer(Request $request)
{
    $validator = Validator::make($request->all(), [
        'prisoner_id' => 'required|exists:prisoners,id',
        'lawyer_id' => 'required|exists:lawyers,lawyer_id',
        'assignment_date' => 'required|date',
        'prison_id' => 'required|exists:prisons,id',
        'assigned_by' => 'required|exists:accounts,user_id',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => $validator->errors()->first()], 422);
    }

    // Check for duplicate assignment
    $exists = LawyerPrisonerAssignment::where('prisoner_id', $request->prisoner_id)
                ->where('lawyer_id', $request->lawyer_id)
                ->exists();

    if ($exists) {
        return response()->json(['message' => 'This prisoner is already assigned to the selected lawyer.'], 409);
    }

    $assignment = LawyerPrisonerAssignment::create($request->all());

    // Notify prisoner
    $prisoner = Prisoner::find($request->prisoner_id);

    $this->createNotification(
        $prisoner->id,
        'prisoner',
        null,
        'lawyer_prisoner_assignment',
        $assignment->id,
        'Lawyer Assigned',
        "A prisoner has been assigned to you: {$prisoner->first_name} {$prisoner->last_name}.",
        $request->prison_id
    );

    return response()->json(['message' => 'Assignment created successfully']);
}
public function assignpolice(Request $request)
{
    $validator = Validator::make($request->all(), [
        'prisoner_id' => 'required|exists:prisoners,id',
        'officer_id' => 'required|exists:accounts,user_id',
        'assignment_date' => 'required|date',
        'prison_id' => 'required|exists:prisons,id',
        'assigned_by' => 'required|exists:accounts,user_id',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => $validator->errors()->first()], 422);
    }

    // Check for duplicate assignment
    $exists = PolicePrisonerAssignment::where('prisoner_id', $request->prisoner_id)
                ->where('officer_id', $request->officer_id)
                ->exists();

    if ($exists) {
        return response()->json(['message' => 'This prisoner is already assigned to the selected police officer.'], 409);
    }

    $assignment = PolicePrisonerAssignment::create($request->all());

    // Notify prisoner
    $prisoner = Prisoner::find($request->prisoner_id);

    $this->createNotification(
        $prisoner->id,
        'prisoner',
        null,
        'police_prisoner_assignment',
        $assignment->id,
        'Police Officer Assigned',
        "A prisoner has been assigned to you: {$prisoner->first_name} {$prisoner->last_name}.",
        $request->prison_id
    );

    return response()->json(['message' => 'Assignment created successfully']);
}

    public function show_all()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);

        if (session('role_id') == 8) {
            return view('police_officer.view_Prisoner', compact('prisoners'));
        } elseif (session('role_id') == 5) {
            return view('police_commisioner.view_prisoner', compact('prisoners'));
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function show_allforin()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);
        return view('inspector.view_Prisoner', compact('prisoners'));
    }
    public function view_appointments()
    {
        $appointments = MedicalAppointment::whereHas('prisoner', function ($query) {
            $query->where('prison_id', session('prison_id'));
        })->paginate(9);

        return view('inspector.view_appointments', compact('appointments'));
    }

    public function view_lawyer_appointments()
    {
        $lawyerAppointments = LawyerAppointment::whereHas('prisoner', function ($query) {
            $query->where('prison_id', session('prison_id'));
        })->paginate(9);

        return view('inspector.view_lawyer_appointments', compact('lawyerAppointments'));
    }

    public function viewJobs()
    {
        $jobs = JobAssignment::whereHas('prisoner', function ($query) {
            $query->where('prison_id', session('prison_id'));
        })->paginate(9);

        return view('inspector.viewJobs', compact('jobs'));
    }

    public function viewTrainingPrograms()
    {
        $trainingprograms = TrainingProgram::paginate(9);

        return view('inspector.viewTrainingPrograms', compact('trainingprograms'));
    }
    public function roomstore(Request $request)
    {
        $request->validate([
            'room_number' => 'required|string|max:20|unique:rooms',
            'capacity' => 'nullable|integer',
            'type' => 'nullable|in:cell,medical,security,training',
            'status' => 'nullable|string',
        ]);

        $room = new Room();
        $room->room_number = $request->room_number;
        $room->capacity = $request->capacity;
        $room->type = $request->type;
        $room->status = $request->status;
        $room->prison_id = $request->prison_id;
        $room->save();

        return back()->with('success', 'Room added successfully!');
    }
    public function roomupdate(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        $request->validate([
            'room_number' => 'required|string|max:20|unique:rooms,room_number,' . $room->id,
            'capacity' => 'nullable|integer',
            'type' => 'nullable|in:cell,medical,security,training',
            'status' => 'nullable|string',
        ]);

        $room->room_number = $request->room_number;
        $room->capacity = $request->capacity;
        $room->type = $request->type;
        $room->status = $request->status;
        $room->prison_id = session('prison_id');
        $room->save();

        return back()->with('success', 'Room updated successfully!');
    }

    public function roomdestroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return back()->with('success', 'Room deleted successfully!');
    }

    public function updateassign(Request $request, $assignment_id)
    {
        $validator = Validator::make($request->all(), [
            'prisoner_id' => 'required|exists:prisoners,id',
            'lawyer_id' => 'required|exists:lawyers,lawyer_id',
            'assignment_date' => 'required|date',
            'prison_id' => 'required|exists:prisons,id',
            'assigned_by' => 'required|exists:accounts,user_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $assignment = LawyerPrisonerAssignment::findOrFail($assignment_id);
        $assignment->update($request->only([
            'prisoner_id',
            'lawyer_id',
            'assignment_date',
            'prison_id',
            'assigned_by'
        ]));

        return response()->json(['message' => 'Assignment updated successfully']);
    }

    public function destroyassign($assignment_id)
    {
        $assignment = LawyerPrisonerAssignment::findOrFail($assignment_id);
        $assignment->delete();
        return response()->json(['message' => 'Assignment deleted successfully']);
    }
    public function show($id)
    {
        $prisoner = Prisoner::where('prison_id', session('prison_id'))
            ->with('prison') // ✅ Eager load the related prison
            ->find($id);

        if (!$prisoner) {
            return response()->json(['error' => 'Prisoner not found'], 404);
        }

        // Format dates using Carbon
        $formattedDob = Carbon::parse($prisoner->dob)->format('F j, Y');
        $formattedTimeServeStart = Carbon::parse($prisoner->time_serve_start)->format('F j, Y');
        $formattedTimeServeEnd = $this->getTimeServeEnd($prisoner->time_serve_end); // Will already be 'Life Sentence' or 'Death Sentence'

        return response()->json([
            'id' => $prisoner->id,
            'first_name' => $prisoner->first_name,
            'middle_name' => $prisoner->middle_name,
            'last_name' => $prisoner->last_name,
            'dob' => $formattedDob,
            'gender' => $prisoner->gender,
            'address' => $prisoner->address,
            'marital_status' => $prisoner->marital_status,
            'crime_committed' => $prisoner->crime_committed,
            'status' => $prisoner->status,
            'time_serve_start' => $formattedTimeServeStart,
            'time_serve_end' => $formattedTimeServeEnd,
            'emergency_contact_name' => $prisoner->emergency_contact_name,
            'emergency_contact_relation' => $prisoner->emergency_contact_relation,
            'emergency_contact_number' => $prisoner->emergency_contact_number,
            'created_at' => Carbon::parse($prisoner->created_at)->format('F j, Y, g:i A'),
            'updated_at' => Carbon::parse($prisoner->updated_at)->format('F j, Y, g:i A'),
            'inmate_image' => $prisoner->inmate_image,
            'prison_name' => $prisoner->prison ? $prisoner->prison->name : 'N/A',
        ]);
    }

    public function getTimeServeEnd($timeServeEnd)
    {
        // Check if the time_serve_end is 'life' or 'death' and handle accordingly
        if ($timeServeEnd === 'Life Sentence') {
            // Log the life sentence case
            Log::info('Time served end is a life sentence');
            return 'Life Sentence';
        }

        if ($timeServeEnd === 'Death Sentence') {
            // Log the death sentence case
            Log::info('Time served end is a death sentence');
            return 'Death Sentence';
        }

        // If time_serve_end is not 'life' or 'death', attempt to parse it as a date
        if ($timeServeEnd) {
            try {
                $parsedDate = Carbon::parse($timeServeEnd);
                return $parsedDate->format('Y-m-d'); // Return the formatted date
            } catch (\Exception $e) {
                // Log the error if parsing fails
                Log::warning('Failed to parse time_serve_end', ['time_serve_end' => $timeServeEnd, 'error' => $e->getMessage()]);
                return 'N/A'; // Return 'N/A' if parsing fails
            }
        }

        // Return 'N/A' if time_serve_end is empty
        return 'N/A';
    }

    public function lstore(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'date_of_birth'   => 'required|date',
            'contact_info'    => 'required|string|max:255',
            'email'          => 'required|email|unique:lawyers,email',
            'password'       => 'required|string|min:6',
            'law_firm'       => 'nullable|string|max:255',
            'license_number' => 'required|string|max:255|unique:lawyers,license_number',
            'cases_handled'  => 'required|integer|min:0',
            'prison'         => 'required|exists:prisons,id',
            'profile_image'  => 'nullable', // Image validation
        ]);

        try {
            // Handle image upload if provided
            $imagePath = null;
            if ($request->hasFile('profile_image')) {
                $imagePath = $request->file('profile_image')->store('lawyer_profiles', 'public');
            }

            // Create a new lawyer
            $lawyer = Lawyer::create([
                'first_name'     => $validatedData['first_name'],
                'last_name'      => $validatedData['last_name'],
                'date_of_birth'  => $validatedData['date_of_birth'],
                'contact_info'   => $validatedData['contact_info'],
                'email'          => $validatedData['email'],
                'password'       => Hash::make($validatedData['password']), // Secure password hashing
                'law_firm'       => $validatedData['law_firm'] ?? null,
                'license_number' => $validatedData['license_number'],
                'cases_handled'  => $validatedData['cases_handled'],
                'prison'         => $validatedData['prison'],
                'profile_image'  => $imagePath, // Save image path
            ]);

            // Log the successful creation
            Log::info('New lawyer created', [
                'lawyer_id' => $lawyer->id,
                'email' => $lawyer->email,
                'prison' => $lawyer->prison,
                'profile_image' => $lawyer->profile_image,
            ]);

            return redirect()->back()->with('success', 'Lawyer added successfully!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating lawyer', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'Failed to add lawyer. Please try again.');
        }
    }


    public function updateStatus(Request $request, $id)
    {
        try {
            $prisoner = Prisoner::where('prison_id', session('prison_id'))
                ->where('prisoner_id', $id)
                ->firstOrFail();

            $prisoner->status = $request->input('status');
            $prisoner->save();

            return response()->json(['success' => true, 'message' => 'Prisoner status updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Error updating prisoner status: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error updating prisoner status.']);
        }
    }
 

    public function store(Request $request)
    {
        // Check age
        $dob = Carbon::parse($request->dob);
        $age = $dob->age;
    
        if ($age < 18) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Prisoner must be at least 18 years old.');
        }
    
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('inmate_image')) {
            $imagePath = $request->file('inmate_image')->store('inmate_images', 'public'); // Saves in storage/app/public/inmate_images
            Log::info('Inmate image uploaded successfully.', ['image_path' => $imagePath]);
        } else {
            Log::warning('No inmate image uploaded.');
        }
    
        try {
            Prisoner::create([
                'prison_id' => $request->prison_id,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'dob' => $request->dob,
                'gender' => $request->sex,
                'address' => $request->address,
                'marital_status' => $request->marital_status,
                'crime_committed' => $request->crime_committed,
                'status' => $request->status,
                'time_serve_start' => $request->time_serve_start,
                'time_serve_end' => $request->time_serve_end,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_relation' => $request->emergency_contact_relation,
                'emergency_contact_number' => $request->emergency_contact_number,
                'inmate_image' => $imagePath, // Store image path
            ]);
    
            return redirect()->back()->with('success', 'Prisoner registered successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to register prisoner.');
        }
    }
    
    public function showroom()
    {
        $rooms = Room::where('prison_id', session('prison_id'))->paginate(9);
        return view('police_officer.view_room', compact('rooms'));
    }
    public function lawyershowall()
    {
        $lawyers = Lawyer::where('prison', session('prison_id'))->paginate(9);
        return view('inspector.view_lawyers', compact('lawyers'));
    }
    public function prisoner_add()

    {
        $prisons = Prison::all();
        return view('.inspector.add_prisoner', compact('prisons'));
    }
    // Update Account
    public function update(Request $request, $id)
    {
        $lawyer = Lawyer::find($id);
        if (!$lawyer) return response()->json(['success' => false, 'message' => 'Account not found'], 404);

        $lawyer->update($request->all());
        return redirect()->back()->with('success', 'Lawyer updated successfully!');
    }

    public function destroy($id)
    {
        $lawyer = Lawyer::find($id);
        if (!$lawyer) return response()->json(['success' => false, 'message' => 'Account not found'], 404);

        $lawyer->delete();
        return redirect()->back()->with('success', 'Lawyer deleted successfully!');
    }
    public function updateasspolice(Request $request, $assignment_id)
    {
        $validator = Validator::make($request->all(), [
            'prisoner_id' => 'required|exists:prisoners,id',
            'officer_id' => 'required|exists:accounts,user_id',
            'assignment_date' => 'required|date',
            'prison_id' => 'required|exists:prisons,id',
            'assigned_by' => 'required|exists:accounts,user_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $assignment = PolicePrisonerAssignment::findOrFail($assignment_id);
        $assignment->update($request->only([
            'prisoner_id',
            'officer_id',
            'assignment_date',
            'prison_id',
            'assigned_by'
        ]));

        return response()->json(['message' => 'Assignment updated successfully']);
    }

    public function destroyasspolice($assignment_id)
    {
        $assignment = PolicePrisonerAssignment::findOrFail($assignment_id);
        $assignment->delete();
        return response()->json(['message' => 'Assignment deleted successfully']);
    }
}
