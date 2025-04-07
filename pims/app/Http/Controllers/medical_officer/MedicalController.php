<?php

namespace App\Http\Controllers\medical_officer;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\MedicalAppointment;
use App\Models\Prisoner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
 


class MedicalController extends Controller
{
    // Show form to create a medical appointment
    public function createMedicalAppointment()
    {
        $appointments = MedicalAppointment::with(['prisoner', 'doctor', 'createdBy'])->latest()->get();
        $prisoners = Prisoner::all();
        $userId = session('user_id'); // <- This gets the session-stored user ID
        $doctors = Account::where('user_id', $userId)->get(); // Filter doctors by session user_id, if needed

        return view('medical_officer.createMedicalAppointment', compact('appointments', 'prisoners', 'doctors'));
    }

   
 

    public function mstore(Request $request)
    {
        // Log incoming request data for debugging
        Log::info('Creating medical appointment', [
            'prisoner_id' => $request->prisoner_id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'status' => $request->status,
            'user_id' => session('user_id'), // Log the user ID from session
        ]);
    
        // Manually validate the required fields
        $errors = [];
    
        if (empty($request->prisoner_id) || !Prisoner::find($request->prisoner_id)) {
            $errors[] = 'Invalid prisoner_id.';
        }
    
        if (empty($request->doctor_id) || !Account::where('user_id', $request->doctor_id)->exists()) {
            $errors[] = 'Invalid doctor_id.';
        }
    
        if (empty($request->appointment_date) || !strtotime($request->appointment_date) || strtotime($request->appointment_date) < time()) {
            $errors[] = 'Invalid appointment_date or it must be today or later.';
        }
    
        if (!in_array($request->status, ['scheduled', 'completed', 'cancelled'])) {
            $errors[] = 'Invalid status. Allowed values: scheduled, completed, cancelled.';
        }
    
        // If there are errors, log and return with an error message
        if (!empty($errors)) {
            Log::error('Validation failed', ['errors' => $errors]);
            return redirect()->back()->withErrors($errors)->withInput();
        }
    
        // Log validation success if no errors
        Log::info('Validation passed', [
            'prisoner_id' => $request->prisoner_id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'status' => $request->status,
        ]);
    
        // Prepare data for insertion, including the user who created it
        $data = $request->all();
        $data['created_by'] = session('user_id') ?? null;
    
        // Create the appointment
        $appointment = MedicalAppointment::create($data);
    
        // Log the successful creation of the appointment
        Log::info('Medical appointment created successfully', [
            'appointment_id' => $appointment->id,
            'user_id' => session('user_id'),
            'appointment_details' => $appointment->toArray(),
        ]);
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Appointment created successfully.');
    }
     

    // Show form to create a medical report
    public function createMedicalReport()
    {
        return view('medical_officer.createMedicalReport');
    }

    // Store the medical report
    public function storeMedicalReport(Request $request)
    {
        // Logic to store the medical report in the database
        // Example: MedicalReport::create($request->all());

        return redirect()->route('medical_officer.viewReports')->with('success', 'Medical report created successfully');
    }

    // View list of medical appointments
    public function viewAppointments()
    {
        // Fetch the medical appointments from the database
        $appointments = MedicalAppointment::all();

        return view('medical_officer.viewAppointments', compact('appointments'));
    }

    // View list of medical reports
    public function viewReports()
    {
        // Fetch the medical reports from the database
        // Example: $reports = MedicalReport::all();

        return view('medical_officer.viewReports', compact('reports'));
    }
}
