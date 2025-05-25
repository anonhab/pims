<?php

namespace App\Http\Controllers\medical_officer;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\MedicalAppointment;
use App\Models\MedicalReport;
use App\Models\Prisoner;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MedicalController extends Controller
{
    // Helper method to create prisoner-related notifications
   // Create a notification
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

// Show form to create a medical appointment
public function createMedicalAppointment()
{
    $prisonId = session('prison_id');
    $userId = session('user_id');

    $appointments = MedicalAppointment::with(['prisoner', 'doctor', 'createdBy'])
                                     ->where('prison_id', $prisonId)
                                     ->latest()
                                     ->get();

    $prisoners = Prisoner::where('prison_id', $prisonId)->get();
    $doctors = Account::where('user_id', $userId)->get();

    return view('medical_officer.createMedicalAppointment', compact('appointments', 'prisoners', 'doctors'));
}

// Store a medical appointment
public function mstore(Request $request)
{
    $prisonId = session('prison_id');
    $userId = session('user_id');

    // Log request entry
    Log::info('Request to create medical appointment received', [
        'by_user_id' => $userId,
        'prison_id' => $prisonId,
        'request_payload' => $request->all()
    ]);

    // Validation
    $errors = [];
    if (empty($request->prisoner_id) || !Prisoner::find($request->prisoner_id)) {
        $errors[] = 'Invalid prisoner_id.';
    }
    if (empty($request->doctor_id) || !Account::where('user_id', $request->doctor_id)->exists()) {
        $errors[] = 'Invalid doctor_id.';
    }
    if (empty($request->appointment_date) || !strtotime($request->appointment_date) || strtotime($request->appointment_date) < strtotime('today')) {
        $errors[] = 'Invalid appointment_date or it must be today or later.';
    }
    if (!in_array($request->status, ['scheduled', 'completed', 'cancelled'])) {
        $errors[] = 'Invalid status. Allowed values: scheduled, completed, cancelled.';
    }

    if (!empty($errors)) {
        Log::warning('Medical appointment validation failed', [
            'user_id' => $userId,
            'errors' => $errors,
            'input_data' => $request->all()
        ]);
        return redirect()->back()->withErrors($errors)->withInput();
    }

    // Prepare data for insertion
    $data = $request->all();
    $data['created_by'] = $userId ?? null;
    $data['prison_id'] = $prisonId;

    // Create appointment
    $appointment = MedicalAppointment::create($data);

    Log::info('Medical appointment record inserted', [
        'appointment_id' => $appointment->id,
        'created_by' => $userId,
        'data' => $appointment->toArray()
    ]);

    // Get prisoner and doctor info
    $prisoner = Prisoner::find($request->prisoner_id);
    $doctor = Account::where('user_id', $request->doctor_id)->first();

    // Notify prisoner
    $this->createNotification(
        $request->prisoner_id,
        'prisoner',
        null,
        'medical_appointments',
        $appointment->id,
        'New Medical Appointment',
        "You have a medical appointment scheduled for {$request->appointment_date}.",
        $prisonId
    );
    Log::info('Notification sent to prisoner', [
        'recipient_id' => $request->prisoner_id,
        'appointment_id' => $appointment->id,
        'date' => $request->appointment_date
    ]);

    // Notify doctor
    $this->createNotification(
        $request->doctor_id,
        'doctor',
        $doctor->role_id ?? null,
        'medical_appointments',
        $appointment->id,
        'New Appointment Assigned',
        "You have been assigned a medical appointment with prisoner {$prisoner->first_name} {$prisoner->last_name} on {$request->appointment_date}.",
        $prisonId
    );
    Log::info('Notification sent to doctor', [
        'recipient_id' => $request->doctor_id,
        'role_id' => $doctor->role_id ?? null,
        'appointment_id' => $appointment->id
    ]);

    // Final success log
    Log::info('Medical appointment successfully completed', [
        'status' => 'success',
        'appointment_id' => $appointment->id,
        'created_by' => $userId
    ]);

    return redirect()->back()->with('success', 'Appointment created successfully.');
}



    // Update medical appointment status
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

    // Store a medical report
    public function mrstore(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'prisoner_id'       => 'required|exists:prisoners,id',
        'appointment_id'    => 'nullable|exists:medical_appointments,id',
        'diagnosis'         => 'required|string',
        'treatment'         => 'nullable|string',
        'medications'       => 'nullable|string',
        'notes'             => 'nullable|string',
        'report_date'       => 'required|date',
        'follow_up'         => 'nullable|boolean',
        'follow_up_date'    => 'nullable|date|after_or_equal:report_date',
    ]);

    $doctorId = session('user_id');
    $doctorAccount = Account::where('user_id', $doctorId)->first();
    $roleId = $doctorAccount?->role_id ?? null;

    $appointment = MedicalAppointment::find($request->appointment_id);
    $prisoner = Prisoner::find($request->prisoner_id);

    Log::info('Storing medical report', [
        'doctor_id' => $doctorId,
        'prisoner_id' => $prisoner->id,
        'appointment_id' => optional($appointment)->id,
    ]);

    // Create the medical report
    $report = MedicalReport::create([
        'prisoner_id'      => $prisoner->id,
        'appointment_id'   => optional($appointment)->id,
        'doctor_id'        => $doctorId,
        'diagnosis'        => $request->diagnosis,
        'treatment'        => $request->treatment,
        'medications'      => $request->medications,
        'notes'            => $request->notes,
        'report_date'      => $request->report_date,
        'follow_up'        => $request->has('follow_up'),
        'follow_up_date'   => $request->follow_up_date,
    ]);

    // Update appointment status if applicable
    if ($appointment) {
        $appointment->update(['status' => 'completed']);
        Log::info('Appointment marked as completed', ['appointment_id' => $appointment->id]);
    }

    // Send notification to prisoner
    $this->createNotification(
        $prisoner->id,
        'prisoner',
        null,
        'medical_reports',
        $report->id,
        'New Medical Report',
        "A medical report has been created  with diagnosis: {$request->diagnosis}.",
        $prisoner->prison_id
    );

    // Send notification to doctor
    $this->createNotification(
        $doctorId,
        'doctor',
        $roleId,
        'medical_reports',
        $report->id,
        'Medical Report Created',
        "You have created a medical report for prisoner {$prisoner->first_name} {$prisoner->last_name}.",
        $prisoner->prison_id
    );

    Log::info('Medical report created successfully', ['report_id' => $report->id]);

    return redirect()->back()->with('success', 'Medical report generated successfully.');
}

    // Store the medical report (redundant, keeping for compatibility)
    public function storeMedicalReport(Request $request)
    {
        return redirect()->route('medical_officer.viewReports')->with('success', 'Medical report created successfully');
    }

    // View list of medical appointments
    public function viewAppointments()
    {
        $appointments = MedicalAppointment::where('prison_id', session('prison_id'))->get();
        return view('medical_officer.viewAppointments', compact('appointments'));
    }

    // View list of medical reports
    public function viewReports()
    {
        $reports = MedicalReport::where('prison_id', session('prison_id'))->get();
        return view('medical_officer.viewReports', compact('reports'));
    }

    // View prisoner-related notifications
    public function viewNotifications(Request $request)
{
    $user = $request->user();
    $role = $user->role_id == 1 ? 'admin' :
            ($user->role_id == 3 ? 'officer' :
            ($user->role_id == 4 ? 'lawyer' : 'prisoner'));

    $notifications = Notification::where('recipient_id', $user->user_id)
        ->where('recipient_role', $role)
        ->whereIn('related_table', ['prisoners', 'rooms', 'lawyer_prisoner_assignments', 'police_prisoner_assignments'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    if ($request->ajax()) {
        return response()->json($notifications);
    }

    return view('inspector.notifications', compact('notifications'));
}
    // Mark a notification as read
    public function markAsRead(Request $request, $notification_id)
    {
        $notification = Notification::where('recipient_id', $request->user()->user_id)
            ->whereIn('related_table', ['medical_appointments', 'medical_reports'])
            ->findOrFail($notification_id);
        $notification->is_read = true;
        $notification->save();

        return response()->json(['message' => 'Notification marked as read']);
    }
}