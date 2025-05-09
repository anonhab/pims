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
use App\Models\Requests;
use Carbon\Carbon;
use App\Models\Room;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class iPrisonerController extends Controller
{
    public function index()
    {
        return view('inspector.add_prisoner');
    }

    public function policeofficer()
    {
        $officers=Account::all();
        $prisoners=Prisoner::all();
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);
        $lawyer = Lawyer::where('prison', session('prison_id'))->paginate(9);
        $assignments = PolicePrisonerAssignment::where('prison_id', session('prison_id'))->paginate(9);
        return view('inspector.assign_policeofficer',compact('officers','prisoners','assignments'));
    }
        public function idashboard()
{
    // Example logic to fetch data — replace these with your actual logic
    $prisonerCount = Prisoner::count();
    $releasedThisMonth = Prisoner::whereMonth('status', now()->month)->count();
    $activeCases = 33;
    $securityIncidents = 88;
    $prisonCapacity = Prison::first()->capacity ?? 1; // avoid division by zero
    $newAdmissions = Prisoner::where('created_at', '>=', now()->subDays(30))->count();
    $medicalCases = MedicalReport::count();
    $staffCount = Account::count();
    $latestPrisonerId = Prisoner::latest()->first()->id ?? 'N/A';
    $medicalEmergencyId = 88;
    $crimeDistribution = []; // Prepare data for your chart

    return view('inspector.dashboard', compact(
        'prisonerCount',
        'crimeDistribution',
        'medicalEmergencyId',
        'latestPrisonerId',
        'staffCount',
        'medicalCases',
        'releasedThisMonth',
        'activeCases',
        'newAdmissions',
        'securityIncidents',
        'prisonCapacity'
    ));
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
        $prisoner = Prisoner::where('prison_id', session('prison_id'))
            ->find($request->id);

        if ($prisoner) {
            $prisoner->room_id = $request->room_id;
            $prisoner->save();
            return back()->with('success', 'Room allocated successfully!');
        }

        return back()->with('error', 'Prisoner not found!');
    }
    public function assignlawyer(Request $request)
    {
        LawyerPrisonerAssignment::create([
            'prisoner_id' => $request->prisoner_id,
            'lawyer_id' => $request->lawyer_id,
            'prison_id' => $request->prison_id,
            'assigned_by' => $request->assigned_by,
            'assignment_date' => $request->assignment_date,
        ]);

        return redirect()->back()->with('success', 'Assignment created successfully.');
    }
    public function assignpolice(Request $request)
    {


        PolicePrisonerAssignment::create([
            'prisoner_id' => $request->prisoner_id,
            'officer_id' => $request->officer_id,
            'prison_id' => $request->prison_id,
            'assigned_by' => $request->assigned_by,
            'assignment_date' => $request->assignment_date,
        ]);

        return redirect()->back()->with('success', 'Assignment created successfully.');
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


            session()->flash('success', 'Prisoner registered successfully!');
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
}
