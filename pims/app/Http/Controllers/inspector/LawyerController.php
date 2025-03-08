<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LawyerController extends Controller
{
    public function lawyer()
    {
        
        return view('inspector.add_lawyer');
    }
}
