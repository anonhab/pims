<?php

namespace App\Http\Controllers\medical_officer;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\MedicalAppointment;
use App\Models\MedicalReport;
use App\Models\Prisoner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MedicalController extends Controller
{
    // Show form to create a medical appointment
    public function createMedicalAppointment()
    {
        $prisonId = session('prison_id'); // Get the session-stored prison ID
        $userId = session('user_id'); // Get the session-stored user ID
    
        // Fetch medical appointments filtered by prison_id
        $appointments = MedicalAppointment::with(['prisoner', 'doctor', 'createdBy'])
                                          ->where('prison_id', $prisonId)
                                          ->latest()
                                          ->get();
    
        // Fetch prisoners filtered by prison_id
        $prisoners = Prisoner::where('prison_id', $prisonId)->get();
    
        // Fetch doctors associated with the current user
        $doctors = Account::where('user_id', $userId)->get();
    
        return view('medical_officer.createMedicalAppointment', compact('appointments', 'prisoners', 'doctors'));
    }
    




    public function mstore(Request $request)
{
    // Retrieve the prison_id from the session
    $prisonId = session('prison_id');

    // Log incoming request data for debugging
    Log::info('Creating medical appointment', [
        'prisoner_id' => $request->prisoner_id,
        'doctor_id' => $request->doctor_id,
        'appointment_date' => $request->appointment_date,
        'diagnosis' => $request->diagnosis,
        'treatment' => $request->treatment,
        'status' => $request->status,
        'user_id' => session('user_id'), // Log the user ID from session
        'prison_id' => $prisonId, // Log the prison_id from session
    ]);

    // Validate fields
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

    // Prepare data for insertion, including the user who created it and the prison_id
    $data = $request->all();
    $data['created_by'] = session('user_id') ?? null;
    $data['prison_id'] = $prisonId; // Add prison_id to the appointment data

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


public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,scheduled,completed',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $appointment = MedicalAppointment::findOrFail($id);
        $appointment->update(['status' => $request->status]);

        return response()->json(['message' => 'Appointment status updated successfully']);
    }
    // Show form to create a medical report
    public function createMedicalReport()
    {
        $prisoners = Prisoner::where('prison_id', session('prison_id'))->get();
        $appointments = MedicalAppointment::where('prison_id', session('prison_id'))->get();

        return view('medical_officer.createMedicalReport', compact('prisoners', 'appointments'));
    }


    public function mrstore(Request $request)
    {
        // Validate incoming data
      

        // Log the incoming request data
        Log::debug('Medical report store request received:', $request->all());

        // Get logged in user (medical officer)
        $doctorId = session('user_id');

        Log::debug('Logged in doctor ID:', ['doctor_id' => $doctorId]);

        // Retrieve appointment and prisoner details
        $appointment = MedicalAppointment::find($request->appointment_id);
        $prisoner = Prisoner::find($request->prisoner_id);

        // Log the appointment and prisoner details
        Log::debug('Appointment details:', ['appointment' => $appointment]);
        Log::debug('Prisoner details:', ['prisoner' => $prisoner]);

        // Create the medical report
        $report = new MedicalReport();
        $report->prisoner_id = $prisoner->id;
        $report->appointment_id = $appointment->id ?? null;

        $report->doctor_id = $doctorId;
        $report->diagnosis = $request->diagnosis;
        $report->treatment = $request->treatment;
        $report->medications = $request->medications;
        $report->notes = $request->notes;
        $report->report_date = $request->report_date;
        $report->follow_up = $request->has('follow_up') ? true : false;
        $report->follow_up_date = $request->follow_up_date ? $request->follow_up_date : null;

        // Log the report data before saving
        Log::debug('Creating medical report with data:', $report->toArray());

        // Save the report
        $report->save();
// Check if the appointment exists
if ($appointment) {
    // Optionally, update appointment status to 'Completed' or similar
    $appointment->status = 'Completed';
    $appointment->save();
} else {
    // Optionally, log an error or handle the case where the appointment is missing
    Log::error('Appointment not found for ID: ' . $request->appointment_id);
}


        // Log the successful save
        Log::debug('Medical report saved successfully.');

        // Return a response (redirect or success message)
        return redirect()->back()->with('success', 'Medical report generated successfully.');
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
