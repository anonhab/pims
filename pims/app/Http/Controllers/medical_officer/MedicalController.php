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
    private function createNotification($recipientId, $recipientRole, $relatedTable, $relatedId, $title, $message)
    {
        Notification::create([
            'recipient_id' => $recipientId,
            'recipient_role' => $recipientRole,
            'related_table' => $relatedTable,
            'related_id' => $relatedId,
            'title' => $title,
            'message' => $message,
            'is_read' => false,
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

        // Log incoming request data
        Log::info('Creating medical appointment', [
            'prisoner_id' => $request->prisoner_id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'status' => $request->status,
            'user_id' => session('user_id'),
            'prison_id' => $prisonId,
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

        if (!empty($errors)) {
            Log::error('Validation failed', ['errors' => $errors]);
            return redirect()->back()->withErrors($errors)->withInput();
        }

        // Prepare data for insertion
        $data = $request->all();
        $data['created_by'] = session('user_id') ?? null;
        $data['prison_id'] = $prisonId;

        // Create the appointment
        $appointment = MedicalAppointment::create($data);

        // Get prisoner and doctor details
        $prisoner = Prisoner::find($request->prisoner_id);
        $doctor = Account::find($request->doctor_id);

        // Notify prisoner
        $this->createNotification(
            $request->prisoner_id,
            'prisoner',
            'medical_appointments',
            $appointment->id,
            'New Medical Appointment',
            "You have a medical appointment scheduled for {$request->appointment_date}."
        );

        // Notify doctor
        $this->createNotification(
            $request->doctor_id,
            'doctor',
            'medical_appointments',
            $appointment->id,
            'New Appointment Assigned',
            "You have been assigned a medical appointment with prisoner {$prisoner->first_name} {$prisoner->last_name} on {$request->appointment_date}."
        );

        // Notify admin
        $admin = Account::where('role_id', 1)->first();
        if ($admin) {
            $this->createNotification(
                $admin->user_id,
                'admin',
                'medical_appointments',
                $appointment->id,
                'New Medical Appointment Created',
                "A medical appointment for prisoner {$prisoner->first_name} {$prisoner->last_name} has been scheduled."
            );
        }

        Log::info('Medical appointment created successfully', [
            'appointment_id' => $appointment->id,
            'user_id' => session('user_id'),
            'appointment_details' => $appointment->toArray(),
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
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'prisoner_id' => 'required|exists:prisoners,id',
            'appointment_id' => 'nullable|exists:medical_appointments,id',
            'diagnosis' => 'required|string',
            'treatment' => 'nullable|string',
            'medications' => 'nullable|string',
            'notes' => 'nullable|string',
            'report_date' => 'required|date',
            'follow_up' => 'nullable|boolean',
            'follow_up_date' => 'nullable|date|after_or_equal:report_date',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed for medical report', ['errors' => $validator->errors()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Log::debug('Medical report store request received:', $request->all());

        $doctorId = session('user_id');
        Log::debug('Logged in doctor ID:', ['doctor_id' => $doctorId]);

        $appointment = MedicalAppointment::find($request->appointment_id);
        $prisoner = Prisoner::find($request->prisoner_id);

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
        $report->follow_up_date = $request->follow_up_date ?: null;

        Log::debug('Creating medical report with data:', $report->toArray());

        $report->save();

        // Update appointment status if exists
        if ($appointment) {
            $appointment->status = 'completed';
            $appointment->save();
        } else {
            Log::warning('Appointment not found for ID: ' . $request->appointment_id);
        }

        // Notify prisoner
        $this->createNotification(
            $prisoner->id,
            'prisoner',
            'medical_reports',
            $report->id,
            'New Medical Report',
            "A medical report has been generated for you with diagnosis: {$request->diagnosis}."
        );

        // Notify doctor
        $this->createNotification(
            $doctorId,
            'doctor',
            'medical_reports',
            $report->id,
            'Medical Report Created',
            "You have created a medical report for prisoner {$prisoner->first_name} {$prisoner->last_name}."
        );

        // Notify admin
        $admin = Account::where('role_id', 1)->first();
        if ($admin) {
            $this->createNotification(
                $admin->user_id,
                'admin',
                'medical_reports',
                $report->id,
                'New Medical Report Generated',
                "A medical report has been generated for prisoner {$prisoner->first_name} {$prisoner->last_name}."
            );
        }

        Log::debug('Medical report saved successfully.');

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