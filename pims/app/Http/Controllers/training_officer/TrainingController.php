<?php

namespace App\Http\Controllers\training_officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    // Show form to assign certifications
    public function assignCertifications()
    {
        return view('training_officer.assignCertifications');
    }

    // Store the assigned certifications
    public function storeCertifications(Request $request)
    {
        // Logic to save certifications to the database
        // Example: Certification::create($request->all());

        return redirect()->route('training_officer.viewCertifications')->with('success', 'Certifications assigned successfully');
    }

    // Show form to assign jobs
    public function assignJobs()
    {
        return view('training_officer.assignJobs');
    }

    // Store the assigned jobs
    public function storeJobs(Request $request)
    {
        // Logic to save jobs to the database
        // Example: Job::create($request->all());

        return redirect()->route('training_officer.viewJobs')->with('success', 'Jobs assigned successfully');
    }

    // Show form to create training programs
    public function createTrainingPrograms()
    {
        return view('training_officer.createTrainingPrograms');
    }

    // Store the training programs
    public function storeTrainingPrograms(Request $request)
    {
        // Logic to save training programs to the database
        // Example: TrainingProgram::create($request->all());

        return redirect()->route('training_officer.viewTrainingPrograms')->with('success', 'Training programs created successfully');
    }

    // View list of certifications
    public function viewCertifications()
    {
        // Fetch the certifications from the database
        // Example: $certifications = Certification::all();
        
        return view('training_officer.viewCertifications');
    }

    // View list of jobs
    public function viewJobs()
    {
        // Fetch the jobs from the database
        // Example: $jobs = Job::all();
        
        return view('training_officer.viewJobs');
    }

    // View list of training programs
    public function viewTrainingPrograms()
    {
        // Fetch the training programs from the database
        // Example: $trainingPrograms = TrainingProgram::all();
        
        return view('training_officer.viewTrainingPrograms');
    }
}
