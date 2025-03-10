<?php
namespace App\Http\Controllers\inspector;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prison;
use App\Models\MedicalAppointment;
use App\Models\LawyerAppointment;
use App\Models\JobAssignment;
use App\Models\TrainingProgram;
use App\Models\Prisoner;
use Illuminate\Support\Facades\Log; // Add this for logging

class iPrisonerController extends Controller
{
    public function index()
    {
        return view('inspector.add_prisoner');
    }
    public function lawyer()
    {
        return view('inspector.add_lawyer');
    }
     public function addroom()
    {
        return view('inspector.allocate_room');
    }
     public function showroom()
    {
        return view('inspector.view_room_allocations');
    }
    public function lawyershowall()
    {
        return view('inspector.view_lawyers');
    }
    public function show_all()
    {
        $prisoners=Prisoner::paginate(9);
        return view('inspector.view_Prisoner',compact('prisoners'));
    }
    
    public function view_appointments()
    {
        $appointments=MedicalAppointment::paginate(9);
        return view('inspector.view_appointments',compact('appointments'));
        }

   
        public function view_lawyer_appointments()
        {
            $lawyerAppointments=LawyerAppointment::paginate(9);
            return view('inspector.view_lawyer_appointments',compact('lawyerAppointments'));
            }

    public function prisoner_add()

    {
        $prisons = Prison::all(); 
        return view('.inspector.add_prisoner',compact('prisons'));
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
public function viewJobs()
{
    // Fetch the jobs from the database
    $jobs = JobAssignment::paginate(9);

    return view('inspector.viewJobs',compact('jobs'));
}

// View list of training programs
public function viewTrainingPrograms()
{
    $trainingprograms = TrainingProgram::paginate(9);

    return view('inspector.viewTrainingPrograms',compact('trainingprograms'));
}

// PrisonerController.php
public function show($id)
{
    $prisoner = Prisoner::find($id); // Fetch prisoner by ID
    if ($prisoner) {
        return response()->json($prisoner); // Return prisoner data as JSON
    }
    return response()->json(['error' => 'Prisoner not found'], 404);
}
public function updateStatus(Request $request, $id)
{
    try {
        // Validate the input status
      

        // Find the prisoner by 'prisoner_id'
        $prisoner = Prisoner::where('prisoner_id', $id)->firstOrFail();
        
        // Update the status column with the new value
        $prisoner->status = $request->input('status');
        $prisoner->save();

        return response()->json(['success' => true, 'message' => 'Prisoner status updated successfully.']);
    } catch (\Exception $e) {
        Log::error('Error updating prisoner status: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Error updating prisoner status.']);
    }
}


}
