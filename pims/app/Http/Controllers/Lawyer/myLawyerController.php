<?php

namespace App\Http\Controllers\lawyer;

use App\Http\Controllers\Controller;
use App\Models\LawyerAppointment;
use App\Models\Requests;
use App\Models\Prisoner;
use Illuminate\Http\Request;
use App\Models\Lawyer;

class myLawyerController extends Controller
{
    public function ldashboard()
    {
        $prisoners = Prisoner::all();
        return view('lawyer.dashboard', compact('prisoners'));
    }
    
    public function myprisoners()
    {
        $lawyer = Lawyer::find(11); // Fetch the lawyer with ID 2

        // Check if the lawyer exists before proceeding
        if (!$lawyer) {
            return "Lawyer not found!";
        }

        // Fetch only prisoners assigned to this lawyer
        $prisoners = $lawyer->assignedPrisoners()->paginate(100);

        return view('lawyer.view_prisoner', compact('prisoners'));
    }


    public function createlegalappo()
    {
        $prisoners = Prisoner::all();
        return view('lawyer.create_legal_appointment', compact('prisoners'));
    }

    public function createrequest()
    {
        $prisoners = Prisoner::all();
        return view('lawyer.create_request', compact('prisoners'));
    }

    public function viewappointment()
    {
        $prisoners = Prisoner::all();
        return view('lawyer.view_appointments', compact('prisoners'));
    }
    public function viewrequest()
    {
        $prisoners = Prisoner::all();
        return view('lawyer.view_requests', compact('prisoners'));
    }
}
