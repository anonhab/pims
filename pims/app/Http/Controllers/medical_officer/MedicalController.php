<?php

namespace App\Http\Controllers\medical_officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicalController extends Controller
{
    // Show form to create a medical appointment
    public function createMedicalAppointment()
    {
        return view('medical_officer.createMedicalAppointment');
    }

    // Store the medical appointment
    public function storeMedicalAppointment(Request $request)
    {
        // Logic to store the medical appointment in the database
        // Example: MedicalAppointment::create($request->all());

        return redirect()->route('medical_officer.viewAppointments')->with('success', 'Medical appointment created successfully');
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
        // Example: $appointments = MedicalAppointment::all();

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
