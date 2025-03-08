<?php

namespace App\Http\Controllers\lawyer;
use App\Http\Controllers\Controller;
use App\Models\Prisoners;
use Illuminate\Http\Request;

class myLawyerController extends Controller
{
    public function myprisoner()
    {
        $prisoners=Prisoners::all();  
        return view('lawyer.view_prisoner',compact('prisoners'));
    }
}

