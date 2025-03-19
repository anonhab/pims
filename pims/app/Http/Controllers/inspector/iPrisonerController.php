<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prison;
use App\Models\MedicalAppointment;
use App\Models\LawyerAppointment;
use App\Models\JobAssignment;
use App\Models\TrainingProgram;
use App\Models\Prisoner;
use App\Models\LawyerPrisonerAssignment;
use App\Models\Lawyer;
use App\Models\Requests;
use App\Models\Room;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class iPrisonerController extends Controller
{
    public function index()
    {
        return view('inspector.add_prisoner');
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
        $lawyer =Lawyer::where('prison', session('prison_id'))->paginate(9);
        $assignments = LawyerPrisonerAssignment::where('prison_id', session('prison_id'))->paginate(9);

        return view('inspector.assign_lawyer', compact('assignments','prisoners','lawyer'));
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

        $rooms = Room::all();
        return view('police_officer.allocate_room', compact('prisoners', 'rooms'));
    }

    public function roomassign()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);
        $rooms = Room::paginate(9);
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
            'prison_id'=> $request->prison_id,
            'assigned_by' => $request->assigned_by,
            'assignment_date' => $request->assignment_date,
        ]);

        return redirect()->back()->with('success', 'Assignment created successfully.');
 
       
    }
    public function show_all()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->paginate(9);
        return view('police_officer.view_Prisoner', compact('prisoners'));
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
        $room->prison_id=$request->prison_id;
        $room->save();

        return back()->with('success', 'Room added successfully!');
    }

    public function show($id)
    {
        $prisoner = Prisoner::where('prison_id', session('prison_id'))
            ->with('prison') // ✅ Eager load the related prison
            ->find($id);
    
        if (!$prisoner) {
            return response()->json(['error' => 'Prisoner not found'], 404);
        }
    
        return response()->json([
            'id' => $prisoner->id,
            'first_name' => $prisoner->first_name,
            'middle_name' => $prisoner->middle_name,
            'last_name' => $prisoner->last_name,
            'dob' => $prisoner->dob,
            'gender' => $prisoner->gender,
            'address' => $prisoner->address,
            'marital_status' => $prisoner->marital_status,
            'crime_committed' => $prisoner->crime_committed,
            'status' => $prisoner->status,
            'time_serve_start' => $prisoner->time_serve_start,
            'time_serve_end' => $prisoner->time_serve_end,
            'emergency_contact_name' => $prisoner->emergency_contact_name,
            'emergency_contact_relation' => $prisoner->emergency_contact_relation,
            'emergency_contact_number' => $prisoner->emergency_contact_number,
            'created_at' => $prisoner->created_at,
            'updated_at' => $prisoner->updated_at,
            'inmate_image' => $prisoner->inmate_image,
    
            // ✅ Fetch the prison name from the relation
            'prison_name' => $prisoner->prison ? $prisoner->prison->name : 'N/A',
        ]);
    }
    public function lstore(Request $request)
    {
        

        // Create a new lawyer
        $lawyer = Lawyer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'contact_info' => $request->contact_info,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password before storing
            'law_firm' => $request->law_firm,
            'license_number' => $request->license_number,
            'cases_handled' => $request->cases_handled,
            'prison_id'=> $request->prison_id,
        ]);

        // Assign the lawyer to the selected prisoner
        $prisoner = Prisoner::findOrFail($request->prisoner_id);
        $prisoner->lawyer_id = $lawyer->id;
        $prisoner->assignment_date = $request->assignment_date;
        $prisoner->assigned_by = $request->assigned_by;
        $prisoner->save();

        // Redirect with a success message 
        return view('inspector.view_lawyers', ['success' => 'Lawyer assigned successfully!']);

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
}
